<x-mail::message>
    # ¡Felicitaciones, {{ $user->name }}! 🌟

    Te informamos que tu cuenta en **Blog - Café Cosecha y Grano** ha sido ascendida a **Editor**.

    Ahora cuentas con los permisos necesarios para gestionar y organizar las categorías y etiquetas de nuestras
    publicaciones y compartir la cultura del café de especialidad con nuestra comunidad.

    <x-mail::button :url="route('blog.list')">
        Ir a mi Panel
    </x-mail::button>

    ¡Bienvenido al equipo editorial!<br>
    {{ config('app.name') }}

    <br>
    <div style="text-align: center;">
        <img src="{{ asset('assets/img/logo/logo_light2.png') }}" alt="Café Cosecha y Grano" width="120" style="margin-top: 20px;">
    </div>
</x-mail::message>
