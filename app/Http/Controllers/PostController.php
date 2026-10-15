<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

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
        // Buscamos el post por su ID y verificamos que el slug coincida
        $post = Post::with(['user', 'categories', 'tags'])->findOrFail($id);

        // Opcional pero recomendado: Si el slug de la URL no coincide con el de la BD, redirigir por SEO
        if ($post->slug !== $slug) {
            return redirect()->route('blog.show', ['id' => $post->id, 'slug' => $post->slug]);
        }

        return view('blog.view', compact('post')); // O 'blog.show' según la ruta de tu archivo blade
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
