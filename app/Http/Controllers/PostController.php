<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. Obtener los últimos 4 posts publicados para el Slider[cite: 3, 4]
        $sliderPosts = Post::with(['user', 'categories'])

            ->latest('published_at')
            ->take(4)
            ->get();

        // 2. Obtener los posts publicados para la grid principal con paginación[cite: 3, 4]
        $posts = Post::with(['user', 'categories', 'tags'])

            ->latest('published_at')
            ->paginate(9);

        // 3. Obtener los posts publicados para la rejilla principal (paginados de 9 en 9)[cite: 3, 4]
        $allPosts = Post::with(['user', 'categories', 'tags'])
            ->latest('published_at')
            ->paginate(9);

        // 4. Retornar la vista welcome con ambas colecciones
        return view('welcome', compact('sliderPosts', 'posts', 'allPosts'));
    }

    /**
     * Muestra el formulario para crear un nuevo post.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('blog.create', compact('categories', 'tags'));
    }

    /**
     * Almacena un nuevo post en la base de datos.
     */
    public function store(Request $request)
    {
        // 1. Validar los datos del formulario
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Máximo 2MB
            'categories' => 'required|array|min:1', // Al menos una categoría seleccionada
            'tags' => 'required|array|min:1', // Al menos una Etiqueta seleccionada
            'status' => 'required|in:borrador,publicado',
        ]);

        // 2. Manejar la subida de la imagen destacada si existe
        $imagePath = null;
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('blog', 'public');
        }

        // 3. Crear el post asociado al usuario autenticado
        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . uniqid(), // Slug único
            'summary' => $request->summary,
            'content' => $request->content,
            'status' => $request->status,
            'featured_image' => $imagePath,
            'published_at' => $request->status == 'publicado' ? now() : null,
        ]);

        // 4. Sincronizar relaciones de categorías y etiquetas
        if ($request->has('categories')) {
            $post->categories()->attach($request->categories);
        }

        if ($request->has('tags')) {
            $post->tags()->attach($request->tags);
        }

        // 5. Redireccionar al listado con un mensaje de éxito
        return redirect()->route('blog.list')->with('success', '¡Post creado exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id, $slug)
    {
        // 1. Buscamos el post por su ID y verificamos que el slug coincida
        $post = Post::with(['user', 'categories', 'tags'])->findOrFail($id);

        // 2. Opcional pero recomendado: Si el slug de la URL no coincide con el de la BD, redirigir por SEO
        if ($post->slug !== $slug) {
            return redirect()->route('blog.show', ['id' => $post->id, 'slug' => $post->slug], 301);
        }

        // 3. Obtenemos los últimos 4 posts publicados para mostrar en la barra lateral
        $latestPosts = Post::query()
            ->where('status', 'publicado')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->latest('id')
            ->take(4)
            ->get();

        // 4. Obtenemos las categorías con el conteo dinámico de sus posts asociados
        $categories = Category::withCount('posts')->get();

        // 5. Navegación: Post Anterior (el ID menor más cercano)
        $previousPost = Post::where('id', '<', $post->id)->orderBy('id', 'desc')->first();

        // 6. Navegación: Post Siguiente (el ID mayor más cercano)
        $nextPost = Post::where('id', '>', $post->id)->orderBy('id', 'asc')->first();

        return view('blog.view', compact('post', 'latestPosts', 'categories', 'previousPost', 'nextPost')); // O 'blog.show' según la ruta de tu archivo blade
    }

    public function blog(Request $request)
    {
        // 1. Capturamos el texto enviado desde el modal de búsqueda
        $search = $request->input('search');

        // 2. Preparamos la consulta base de posts
        $postsQuery = Post::with(['user', 'categories', 'tags'])
            ->latest('published_at');

        // 3. Si el usuario busco algo, filtramos por título o contenido
        if ($search) {
            $postsQuery->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('content', 'LIKE', "%{$search}%");
            });
        }

        // 4. Obtenemos los posts con paginación y conservamos la búsqueda en los enlaces de página
        $posts = $postsQuery->paginate(6)->appends(['search' => $search]);

        $latestPosts = Post::query()
            ->where('status', 'publicado')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->latest('id')
            ->take(4)
            ->get();

        $categories = Category::withCount('posts')->get();

        $tags = $posts->getCollection()
            ->flatMap(fn($post) => $post->tags)
            ->unique('id')
            ->values();

        return view('blog.index', compact('posts', 'latestPosts', 'categories', 'tags', 'search'));
    }

    // Listar los posts del usuario con sesión activa
    public function myPosts()
    {
        // Obtenemos los posts del usuario logueado, paginados de 6 en 6
        $posts = Post::where('user_id', Auth::id())
            ->latest('updated_at')
            ->latest('id')
            ->paginate(6);

        return view('blog.list', compact('posts'));
    }



    // Filtrar por Categoría
    public function byCategory(Category $category, Request $request)
    {
        $search = trim($request->input('search'));

        // Asumiendo que la relación en el modelo Category se llama 'posts'
        $postsQuery = $category->posts()
            ->with(['user', 'categories', 'tags'])
            ->latest('published_at');

        if ($search) {
            $postsQuery->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('content', 'LIKE', "%{$search}%");
            });
        }

        $posts = $postsQuery->paginate(6)->appends(['search' => $search]);

        $latestPosts = Post::query()
            ->where('status', 'publicado')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->latest('id')
            ->take(4)
            ->get();

        $categories = Category::withCount('posts')->get();

        $tags = Post::with('tags')->get()
            ->flatMap(fn($post) => $post->tags)
            ->unique('id')
            ->values();

        return view('blog.index', compact('posts', 'latestPosts', 'categories', 'tags', 'search', 'category'));
    }

    // Filtrar por Tag / Etiqueta
    public function byTag(Tag $tag, Request $request)
    {
        $search = trim($request->input('search'));

        // Asumiendo que la relación en el modelo Tag se llama 'posts'
        $postsQuery = $tag->posts()
            ->with(['user', 'categories', 'tags'])
            ->latest('published_at');

        if ($search) {
            $postsQuery->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('content', 'LIKE', "%{$search}%");
            });
        }

        $posts = $postsQuery->paginate(6)->appends(['search' => $search]);

        $latestPosts = Post::query()
            ->where('status', 'publicado')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->latest('id')
            ->take(4)
            ->get();

        $categories = Category::withCount('posts')->get();

        $tags = Post::with('tags')->get()
            ->flatMap(fn($post) => $post->tags)
            ->unique('id')
            ->values();

        return view('blog.index', compact('posts', 'latestPosts', 'categories', 'tags', 'search', 'tag'));
    }

    /**
     * Muestra el formulario para editar un post existente.
     */
    public function edit(Post $post)
    {
        // Opcional de seguridad: verificar que el post sea del usuario logueado
        if ($post->user_id !== Auth::id()) {
            abort(403, 'No tienes permisos para editar este blog.');
        }

        $categories = Category::all();
        $tags = Tag::all();

        return view('blog.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Actualiza el post en la base de datos.
     */
    public function update(Request $request, Post $post)
    {
        // Validación de seguridad de propiedad
        if ($post->user_id !== Auth::id()) {
            abort(403, 'No tienes permisos para modificar este blog.');
        }

        // 1. Validar los datos del formulario (imagen opcional al editar, máx 5MB)
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Máximo 2MB
            'categories' => 'required|array|min:1',
            'tags' => 'required|array|min:1',
            'status' => 'required|in:borrador,publicado',
        ]);

        // 2. Manejar la nueva imagen destacada si se subió una
        $imagePath = $post->featured_image; // Mantenemos la anterior por defecto
        if ($request->hasFile('featured_image')) {
            // Eliminar la imagen anterior si existe físicamente
            if ($post->featured_image && Storage::disk('public')->exists($post->featured_image)) {
                Storage::disk('public')->delete($post->featured_image);
            }
            // Guardar la nueva
            $imagePath = $request->file('featured_image')->store('blog', 'public');
        }

        // 3. Actualizar los datos del post
        $post->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . $post->id, // Actualizamos el slug manteniendo el ID único
            'summary' => $request->summary,
            'content' => $request->content,
            'status' => $request->status,
            'featured_image' => $imagePath,
            'published_at' => $request->status == 'publicado' && !$post->published_at ? now() : $post->published_at,
        ]);

        // 4. Sincronizar las relaciones de categorías y etiquetas
        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        // 5. Redireccionar al listado con mensaje de éxito
        return redirect()->route('blog.list')->with('success', '¡Blog actualizado exitosamente!');
    }

    /**
     * Elimina un post de la base de datos.
     */
    public function destroy(Post $post)
    {
        // Validación de seguridad: verificar que el post sea del usuario logueado
        if ($post->user_id !== Auth::id()) {
            abort(403, 'No tienes permisos para eliminar este artículo.');
        }

        // 1. Eliminar la imagen destacada del almacenamiento físico si existe
        if ($post->featured_image && Storage::disk('public')->exists($post->featured_image)) {
            Storage::disk('public')->delete($post->featured_image);
        }

        // 2. Desvincular las relaciones de categorías y etiquetas
        $post->categories()->detach();
        $post->tags()->detach();

        // 3. Eliminar el post
        $post->delete();

        // 4. Redireccionar al listado con un mensaje de éxito
        return redirect()->route('blog.list')->with('success', '¡Artículo eliminado exitosamente!');
    }
}
