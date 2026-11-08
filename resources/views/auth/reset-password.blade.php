@extends('layouts.base')

@section('title', 'Restablecer Contraseña - Café Cosecha y Grano')

@section('content')
    <section class="m-top mb-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="widget p-4 border rounded shadow-sm">
                        <div class="text-center mb-4">
                            <h3 class="mb-2">Nueva Contraseña</h3>
                            <p class="text-muted small">Por favor, ingresa tu nueva contraseña para tu cuenta en Café Cosecha
                                y Grano.</p>
                        </div>

                        <form method="POST" action="{{ route('password.store') }}">
                            @csrf

                            <!-- Token de restablecimiento -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <!-- Correo Electrónico -->
                            <div class="form-group mb-3">
                                <label for="email" class="form-label font-weight-bold">Correo Electrónico</label>
                                <input id="email" type="email"
                                    class="form-control widget__form-input @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email', $request->email) }}" required autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nueva Contraseña -->
                            <div class="form-group mb-3">
                                <label for="password" class="form-label font-weight-bold">Nueva Contraseña</label>
                                <input id="password" type="password"
                                    class="form-control widget__form-input @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password" placeholder="••••••••">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirmar Contraseña -->
                            <div class="form-group mb-3">
                                <label for="password_confirmation" class="form-label font-weight-bold">Confirmar
                                    Contraseña</label>
                                <input id="password_confirmation" type="password" class="form-control widget__form-input"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="••••••••">
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn-custom">
                                    Restablecer Contraseña
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--newslettre-->
    @include('partials.newslettre')

@endsection
