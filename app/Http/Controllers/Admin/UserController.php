<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\RoleUpdatedToEditorNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

        // Si solicita ver la papelera
        if ($request->has('trash')) {
            $users = User::onlyTrashed()->get();
            $isTrashView = true;
        } else {
            $users = User::all();
            $isTrashView = false;
        }

        // Consultamos los usuarios filtrando por nombre o correo si hay búsqueda
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })
            ->latest()
            ->paginate(10)
            ->withQueryString(); // Mantiene el parámetro de búsqueda al paginar

        return view('admin.users.index', compact('users', 'search', 'isTrashView'));
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

        // 1. Guardamos el rol anterior antes de actualizar
        $oldRole = $user->role;
        $newRole = $request->role;

        // 2. Actualizamos el usuario con el nuevo rol
        $user->update([
            'role' => $newRole,
        ]);

        // 3. NUEVO: Si antes era 'user' y ahora pasa a ser 'editor', enviamos la notificación
        if ($oldRole === 'user' && $newRole === 'editor') {
            Mail::to($user->email)->send(new RoleUpdatedToEditorNotification($user));
        }

        return back()->with('success', "¡El rol de {$user->name} ha sido actualizado exitosamente!");
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Soft delete

        return redirect()->route('admin.users.index')->with('success', 'Usuario enviado a la papelera correctamente.');
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('admin.users.index', ['trash' => 1])->with('success', 'Usuario restaurado exitosamente.');
    }

    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete(); // Borrado definitivo

        return redirect()->route('admin.users.index', ['trash' => 1])->with('success', 'Usuario eliminado permanentemente.');
    }
}
