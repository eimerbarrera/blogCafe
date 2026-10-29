@extends('layouts.base')

@section('title', 'Blog - Cosecha y Grano')

@section('content')

    <!-- Register Section -->
    <section class="m-top mb-60">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="widget">
                        <h5 class="widget__title">Crear Cuenta</h5>

                        <form class="widget__form contact_form" action="{{ route('register') }}" method="POST">
                            @csrf

                            <!-- Nombre / Username -->
                            <div class="form-group mb-3">
                                <input type="text"
                                    class="form-control widget__form-input @error('name') is-invalid @enderror"
                                    placeholder="Nombre completo*" name="name" value="{{ old('name') }}" required
                                    autofocus autocomplete="name">
                                @error('name')
                                    <span class="invalid-feedback d-block mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Correo Electrónico -->
                            <div class="form-group mb-3">
                                <input type="email"
                                    class="form-control widget__form-input @error('email') is-invalid @enderror"
                                    placeholder="Correo electrónico*" name="email" value="{{ old('email') }}" required
                                    autocomplete="username">
                                @error('email')
                                    <span class="invalid-feedback d-block mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Contraseña -->
                            <div class="form-group mb-3">
                                <input type="password"
                                    class="form-control widget__form-input @error('password') is-invalid @enderror"
                                    placeholder="Contraseña*" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback d-block mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Confirmar Contraseña (Requerido por Breeze) -->
                            <div class="form-group mb-3">
                                <input type="password"
                                    class="form-control widget__form-input @error('password_confirmation') is-invalid @enderror"
                                    placeholder="Confirmar contraseña*" name="password_confirmation" required
                                    autocomplete="new-password">
                                @error('password_confirmation')
                                    <span class="invalid-feedback d-block mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Términos y Condiciones -->
                            <div class="widget__form-controls form-group mb-3">
                                <div class="widget__form-controls-checkbox">
                                    <input type="checkbox" class="widget__form-controls-input" id="terms" required>
                                    <label class="widget__form-controls-label" for="terms">
                                        Acepto los <a href="#" class="widget__form-link">términos y condiciones</a>
                                    </label>
                                </div>
                            </div>

                            <!-- Botón de Registro -->
                            <div class="widget__form-btn mb-3">
                                <button type="submit" class="btn-custom w-100">Registrarse Ahora</button>
                            </div>

                            <!-- Enlace para ir al Login -->
                            <p class="widget__form-text text-center">
                                ¿Ya tienes una cuenta?
                                <a href="{{ route('login') }}" class="widget__form-link">Iniciar Sesión</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--newslettre-->
    @include('partials.newslettre')

@endsection

{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
 --}}
