<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;

class CategoryController extends Controller implements HasMiddleware
{
    /**
     * Aplica middleware del controlador; el grupo de rutas también protege el índice.
     */
    public static function middleware(): array
    {
        return [new Middleware(['auth', 'admin_or_editor'], except: ['index', 'show'])];
    }

    /**
     * Muestra la lista de categorías.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        return view('categories.index', compact('categories'));
    }

    /**
     * Muestra el formulario para crear una nueva categoría.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     *  Almacena una nueva categoría en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:500',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')->with('success', '¡Categoría creada exitosamente!');
    }

    /**
     *Muestra el recurso especificado (Opcional según tu lógica pública).
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);

        // Aquí podrías retornar una vista pública si lo deseas
        return view('categories.show', compact('category'));
    }

    /**
     * Muestra el formulario para editar una categoría existente.
     */
    public function edit(Category $category) // Usamos Route Model Binding para mayor limpieza
    {
        $categories = Category::latest()->paginate(10);
        $categoryEditing = $category; // Variable para llenar el formulario de edición

        return view('categories.index', compact('categories', 'categoryEditing'));
    }

    /**
     * Actualiza la categoría especificada en la base de datos.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,'.$category->id,
            'description' => 'nullable|string|max:500',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')->with('success', '¡Categoría actualizada exitosamente!');
    }

    /**
     * Elimina la categoría especificada de la base de datos.
     */
    public function destroy(Category $category)
    {
        // Validar si tiene posts asociados antes de eliminar
        if ($category->posts()->count() > 0) {
            return back()->with('error', 'No se puede eliminar la categoría porque tiene artículos asociados.');
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', '¡Categoría eliminada exitosamente!');
    }
}
