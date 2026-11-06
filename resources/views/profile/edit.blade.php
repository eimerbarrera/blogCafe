@extends('layouts.base')

@section('title', 'Mi Perfil - Cosecha y Grano')

@section('content')

    <section class="banner">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="banner__content">
                        <h3 class="banner__title mb-0">
                            Configuración del Perfil
                        </h3>
                        <p class="banner__subtitle mb-0">
                            Actualiza tu información personal, biografía y enlaces de redes sociales en Cosecha y Grano.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <a href="{{ route('blog.list') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Volver a Mis Publicaciones
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Formulario de Edición de Perfil -->
    <section class="">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 m-auto">

                    @if (session('status') === 'profile-updated')
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            ¡Perfil actualizado exitosamente!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Tarjeta 1: Información Personal y Redes -->
                    <div class="widget p-4 border rounded shadow-sm mb-4">
                        <h4 class="mb-4">Información del Perfil y Redes Sociales</h4>

                        <form action="{{ route('profile.update') }}" method="POST" class="widget__form">
                            @csrf
                            @method('patch')

                            <!-- Nombre -->
                            <div class="form-group mb-3">
                                <label for="name" class="form-label font-weight-bold">Nombre Completo*</label>
                                <input type="text"
                                    class="form-control widget__form-input @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Correo Electrónico -->
                            <div class="form-group mb-3">
                                <label for="email" class="form-label font-weight-bold">Correo Electrónico*</label>
                                <input type="email"
                                    class="form-control widget__form-input @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Descripción / Biografía -->
                            <div class="form-group mb-3">
                                <label for="description" class="form-label font-weight-bold">Biografía / Descripción</label>
                                <textarea class="form-control widget__form-input @error('description') is-invalid @enderror" id="description"
                                    name="description" rows="3" placeholder="Cuéntanos un poco sobre ti y tu pasión por el café...">{{ old('description', $user->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Redes Sociales -->
                            <div class="row">
                                <div class="col-md-4 form-group mb-3">
                                    <label for="urlfacebook" class="form-label font-weight-bold">URL de Facebook</label>
                                    <input type="url"
                                        class="form-control widget__form-input @error('urlfacebook') is-invalid @enderror"
                                        id="urlfacebook" name="urlfacebook"
                                        value="{{ old('urlfacebook', $user->urlfacebook) }}"
                                        placeholder="https://facebook.com/tu-usuario">
                                    @error('urlfacebook')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 form-group mb-3">
                                    <label for="urlinstagram" class="form-label font-weight-bold">URL de Instagram</label>
                                    <input type="url"
                                        class="form-control widget__form-input @error('urlinstagram') is-invalid @enderror"
                                        id="urlinstagram" name="urlinstagram"
                                        value="{{ old('urlinstagram', $user->urlinstagram) }}"
                                        placeholder="https://instagram.com/tu-usuario">
                                    @error('urlinstagram')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 form-group mb-3">
                                    <label for="urlyoutube" class="form-label font-weight-bold">URL de YouTube</label>
                                    <input type="url"
                                        class="form-control widget__form-input @error('urlyoutube') is-invalid @enderror"
                                        id="urlyoutube" name="urlyoutube"
                                        value="{{ old('urlyoutube', $user->urlyoutube) }}"
                                        placeholder="https://youtube.com/@tu-canal">
                                    @error('urlyoutube')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Botón Guardar -->
                            <div class="text-end mt-4">
                                <button type="submit" class="btn-custom px-4" style="max-width: 220px;">Guardar
                                    Cambios</button>
                            </div>
                        </form>
                    </div>

                    <!-- Tarjeta 2: Actualizar Contraseña -->
                    <div class="widget p-4 border rounded shadow-sm">
                        <h4 class="mb-4">Actualizar Contraseña</h4>

                        @if (session('status') === 'password-updated')
                            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                ¡Contraseña actualizada exitosamente!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('password.update') }}" method="POST" class="widget__form">
                            @csrf
                            @method('put')

                            <div class="form-group mb-3">
                                <label for="current_password" class="form-label font-weight-bold">Contraseña
                                    Actual</label>
                                <input type="password"
                                    class="form-control widget__form-input @error('current_password', 'updatePassword') is-invalid @enderror"
                                    id="current_password" name="current_password" required>
                                @error('current_password', 'updatePassword')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password" class="form-label font-weight-bold">Nueva Contraseña</label>
                                <input type="password"
                                    class="form-control widget__form-input @error('password', 'updatePassword') is-invalid @enderror"
                                    id="password" name="password" required>
                                @error('password', 'updatePassword')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password_confirmation" class="form-label font-weight-bold">Confirmar Nueva
                                    Contraseña</label>
                                <input type="password" class="form-control widget__form-input" id="password_confirmation"
                                    name="password_confirmation" required>
                            </div>

                            <div class="text-end mt-4">
                                <button type="submit" class="btn-custom px-4" style="max-width: 220px;">Actualizar
                                    Contraseña</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!--newsletter-->
    @include('partials.newslettre')

@endsection
