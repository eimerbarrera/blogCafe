<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/blog/categoria/{category:slug}', [PostController::class, 'byCategory'])
    ->name('blog.category');

Route::get('/blog/etiqueta/{tag:slug}', [PostController::class, 'byTag'])
    ->name('blog.tag');

Route::get('/blog/{id}/{slug}', [PostController::class, 'show'])
    ->where(['id' => '[0-9]+'])
    ->name('blog.show');

Route::get('/blog', [PostController::class, 'blog'])->name('blog.index');

Route::view('/contacto', 'contact.index')->name('contact.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/mis-posts', [PostController::class, 'myPosts'])->name('blog.list');

    // Rutas para la creación de posts
    Route::get('/mis-posts/crear', [PostController::class, 'create'])->name('posts.create');
    Route::post('/mis-posts', [PostController::class, 'store'])->name('posts.store');

    // --- Rutas para la edición y actualización de posts ---
    Route::get('/mis-posts/{post}/editar', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/mis-posts/{post}', [PostController::class, 'update'])->name('posts.update');
});

require __DIR__.'/auth.php';
