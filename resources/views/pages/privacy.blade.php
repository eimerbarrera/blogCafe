@extends('layouts.base')

@section('title', 'Política de Privacidad - Café Cosecha y Grano')

@section('content')

    <!-- Banner Superior -->
    <section class="banner">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="banner__content">
                        <h3 class="banner__title mb-0">
                            Política de Privacidad
                        </h3>
                        <p class="banner__subtitle mb-0">
                            Comprometidos con la transparencia y el respeto hacia nuestra comunidad de amantes del café, caficultores y
                            lectores.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <a href="{{ url('/') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Volver al Inicio
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contenido de la Política de Privacidad -->
    <section class="mb-60">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="widget p-5 border rounded shadow-sm">

                        <h4 class="mb-4">1. Información General y Responsable</h4>
                        <p class="text-muted">
                            En <strong>Café Cosecha y Grano</strong> (en adelante, "el Blog"), accesible desde
                            <code>cosechaygrano.com</code>, valoramos y protegemos la privacidad de los datos personales de
                            nuestros usuarios, lectores, editores y colaboradores. Esta política describe qué información
                            recopilamos, con qué propósito y cómo la resguardamos.
                        </p>

                        <h4 class="mt-4 mb-4">2. Datos que Recopilamos</h4>
                        <p class="text-muted">
                            Recopilamos únicamente la información necesaria para el funcionamiento de la comunidad y la
                            gestión de contenidos:
                        </p>
                        <ul class="text-muted mb-4">
                            <li><strong>Datos de registro:</strong> Nombre, dirección de correo electrónico y contraseña
                                encriptada.</li>
                            <li><strong>Información de perfil opcional:</strong> Biografía personal y enlaces a redes
                                sociales (Facebook, Instagram, YouTube) para aquellos usuarios que deseen visibilizar su
                                perfil en el blog.</li>
                            <li><strong>Datos de navegación:</strong> Información técnica básica recopilada a través de
                                cookies estándar para mejorar la experiencia de lectura en modo claro y oscuro.</li>
                        </ul>

                        <h4 class="mt-4 mb-4">3. Finalidad del Tratamiento de los Datos</h4>
                        <p class="text-muted">
                            Los datos proporcionados son utilizados exclusivamente para:
                        </p>
                        <ul class="text-muted mb-4">
                            <li>Gestionar el acceso a las cuentas de usuario, editores y administradores.</li>
                            <li>Enviar notificaciones importantes del sistema (como confirmaciones de registro o avisos de
                                cambios de roles editoriales).</li>
                            <li>Visibilizar las publicaciones, artículos y el esfuerzo detrás de cada proceso cafetalero
                                compartido en la plataforma.</li>
                        </ul>

                        <h4 class="mt-4 mb-4">4. Protección de la Información</h4>
                        <p class="text-muted">
                            Implementamos medidas de seguridad técnicas y organizativas adecuadas para proteger tu
                            información personal contra accesos no autorizados, pérdida o alteración. No compartimos
                            información personal con terceros con fines comerciales.
                        </p>

                        <h4 class="mt-4 mb-4">5. Contacto</h4>
                        <p class="text-muted">
                            Si tienes alguna duda, inquietud o solicitud relacionada con esta Política de Privacidad, puedes
                            ponerte en contacto con nuestro equipo a través de los canales oficiales disponibles en el sitio
                            web de Café Cosecha y Grano.
                        </p>

                        <div class="mt-5 pt-3 border-top text-muted small">
                            <em>Última actualización: Noviembre de 2026. Café Cosecha y Grano. ©Todos los derechos
                                reservados.</em>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    @include('partials.newslettre')

@endsection
