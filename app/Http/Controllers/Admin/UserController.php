<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Muestra la lista de usuarios del sistema.
     */
    /**
     * Muestra la lista de usuarios del sistema con opción de búsqueda.
     */
    public function index(Request $request)
    {
        // Capturamos el término de búsqueda si existe
        $search = $request->input('search');

        // Consultamos los usuarios filtrando por nombre o correo si hay búsqueda
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })
            ->latest()
            ->paginate(10)
            ->withQueryString(); // Mantiene el parámetro de búsqueda al paginar

        return view('admin.users.index', compact('users', 'search'));
    }

    /**
     * Actualiza el rol de un usuario (admin, editor, user).
     */
    public function updateRole(Request $request, User $user)
    {
        // Validar que el rol sea uno de los permitidos
        $request->validate([
            'role' => 'required|in:admin,editor,user',
        ]);

        // Evitar que el admin se quede sin rol de admin a sí mismo por accidente
        if ($user->id === Auth::id() && $request->role !== 'admin') {
            return back()->with('error', 'No puedes quitarte el rol de administrador a ti mismo.');
        }

        $user->update([
            'role' => $request->role,
        ]);

        return back()->with('success', "¡El rol de {$user->name} ha sido actualizado exitosamente!");
    }
}
