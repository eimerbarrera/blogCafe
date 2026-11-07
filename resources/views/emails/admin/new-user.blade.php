<x-mail::message>
    # ¡Nuevo registro en Blog - Café Cosecha y Grano! ☕

    Hola Administrador,

    Se ha registrado un nuevo usuario en la plataforma con los siguientes datos:

    - **Nombre:** {{ $user->name }}
    - **Correo Electrónico:** {{ $user->email }}
    - **Fecha de Registro:** {{ $user->created_at->format('d/m/Y H:i') }}

    <x-mail::button :url="route('admin.users.index')">
        Gestionar Usuarios
    </x-mail::button>

    Gracias,<br>
    {{ config('app.name') }}
</x-mail::message>
