<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
            ->where('status', 'published')
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
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->latest('id')
            ->take(4)
            ->get();

        $categories = Category::withCount('posts')->get();

        $tags = $posts->getCollection()
            ->flatMap(fn ($post) => $post->tags)
            ->unique('id')
            ->values();

        return view('blog.index', compact('posts', 'latestPosts', 'categories', 'tags', 'search'));
    }

    // Listar los posts del usuario con sesión activa
public function myPosts()
{
    // Obtenemos los posts del usuario logueado, paginados de 6 en 6
    $posts = Post::where('user_id', Auth::id())
                ->latest('published_at')
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
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->latest('id')
            ->take(4)
            ->get();

        $categories = Category::withCount('posts')->get();

        $tags = Post::with('tags')->get()
            ->flatMap(fn ($post) => $post->tags)
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
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->latest('id')
            ->take(4)
            ->get();

        $categories = Category::withCount('posts')->get();

        $tags = Post::with('tags')->get()
            ->flatMap(fn ($post) => $post->tags)
            ->unique('id')
            ->values();

        return view('blog.index', compact('posts', 'latestPosts', 'categories', 'tags', 'search', 'tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
