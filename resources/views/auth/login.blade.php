@extends('layouts.base')

@section('title', 'Blog - Cosecha y Grano')

@section('content')

    <!--Login-->
    <section class="m-top mb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="widget">
                        <h5 class="widget__title">Iniciar Sesión</h5>

                        <!-- Mensaje de Estado de Sesión (Ej: si solicitó reset de clave) -->
                        @if (session('status'))
                            <div class="alert alert-success mb-4" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('login') }}" class="widget__form" method="POST">
                            @csrf

                            <!-- Email Address (Cambiado de username a email para Breeze) -->
                            <div class="form-group mb-3">
                                <input type="email"
                                    class="form-control widget__form-input @error('email') is-invalid @enderror"
                                    placeholder="Correo electrónico*" name="email" value="{{ old('email') }}" required
                                    autofocus autocomplete="username">
                                @error('email')
                                    <span class="invalid-feedback d-block mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-group mb-3">
                                <input type="password"
                                    class="form-control widget__form-input @error('password') is-invalid @enderror"
                                    placeholder="Contraseña*" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback d-block mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Controls: Remember Me & Forgot Password -->
                            <div
                                class="widget__form-controls form-group d-flex justify-content-between align-items-center mb-3">
                                <div class="widget__form-controls-checkbox">
                                    <input type="checkbox" class="widget__form-controls-input" id="rememberMe"
                                        name="remember">
                                    <label class="widget__form-controls-label" for="rememberMe">Recordarme</label>
                                </div>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="widget__form-link ml-auto">
                                        ¿Olvidaste tu contraseña?
                                    </a>
                                @endif
                            </div>

                            <!-- Botón Submit -->
                            <div class="widget__form-btn mb-3">
                                <button type="submit" class="btn-custom w-100">Iniciar Sesión</button>
                            </div>

                            <!-- Enlace a Registro -->
                            @if (Route::has('register'))
                                <p class="widget__form-text text-center">
                                    ¿No tienes una cuenta?
                                    <a href="{{ route('register') }}" class="widget__form-link">Regístrate aquí</a>
                                </p>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--newslettre-->
    @include('partials.newslettre')

@endsection
