@extends('layouts.base')

@section('title', 'Recuperar Contraseña - Café Cosecha y Grano')

@section('content')
    <section class="m-top mb-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="widget p-4 border rounded shadow-sm">
                        <div class="text-center mb-4">
                            <h3 class="mb-2">¿Olvidaste tu contraseña?</h3>
                            <p class="text-muted small">
                                No te preocupes. Escribe tu correo electrónico y te enviaremos un enlace de recuperación
                                para que elijas una nueva.
                            </p>
                        </div>

                        <!-- Estado de la sesión -->
                        @if (session('status'))
                            <div class="alert alert-success mb-4" role="alert">
                                @if (session('status') == 'We have emailed your password reset link.')
                                    Te hemos enviado por correo el enlace para restablecer tu contraseña.
                                @else
                                    {{ session('status') }}
                                @endif
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <!-- Correo Electrónico -->
                            <div class="form-group mb-3">
                                <label for="email" class="form-label font-weight-bold">Correo Electrónico</label>
                                <input id="email" type="email"
                                    class="form-control widget__form-input @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autofocus
                                    placeholder="tucorreo@dominio.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn-custom">
                                    Enviar Enlace de Recuperación
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
