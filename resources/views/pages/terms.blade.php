@extends('layouts.base')

@section('title', 'Términos y Condiciones - Café Cosecha y Grano')

@section('content')

    <!-- Banner Superior -->
    <section class="banner">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="banner__content">
                        <h3 class="banner__title mb-0">
                            Términos y Condiciones de Uso
                        </h3>
                        <p class="banner__subtitle mb-0">
                            Lineamientos y normas de convivencia para nuestra comunidad apasionada por el café, su historia y sus procesos.
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

    <!-- Contenido de Términos y Condiciones -->
    <section class="mb-60">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="widget p-5 border rounded shadow-sm">

                        <h4 class="mb-4">1. Disposiciones Generales</h4>
                        <p class="text-muted">
                            El acceso y uso del sitio web <code>cosechaygrano.com</code> (en adelante, <strong>Blog- Café Cosecha
                                y Grano</strong>) atribuye la condición de usuario a quien lo navegue, implicando la
                            aceptación total y sin reservas de los presentes Términos y Condiciones. Si no estás de acuerdo
                            con ellos, te sugerimos no utilizar la plataforma.
                        </p>

                        <h4 class="mt-4 mb-4">2. Uso de la Plataforma y Roles de Usuario</h4>
                        <p class="text-muted">
                            El blog cuenta con diferentes niveles de interacción y roles asignados por la administración:
                        </p>
                        <ul class="text-muted mb-4">
                            <li><strong>Usuarios Registrados:</strong> Pueden interactuar, gestionar su perfil personal y
                                participar en la comunidad cafetera.</li>
                            <li><strong>Editores:</strong> Cuentan con permisos para redactar, organizar
                                categorías/etiquetas y visibilizar historias de caficultores y procesos de café.</li>
                            <li><strong>Administradores:</strong> Gestionan la seguridad general, los roles y la moderación
                                de la plataforma.</li>
                        </ul>
                        <p class="text-muted">
                            El usuario se compromete a hacer un uso lícito de los contenidos, evitando publicar material
                            ofensivo, discriminatorio, spam o contrario a las buenas costumbres.
                        </p>

                        <h4 class="mt-4 mb-4">3. Propiedad Intelectual</h4>
                        <p class="text-muted">
                            Todo el contenido publicado en Café Cosecha y Grano (artículos, fotografías, logotipos,
                            estructura de diseño y recursos gráficos) está protegido por las leyes de propiedad
                            intelectual. Queda prohibida su reproducción total o parcial sin autorización expresa del
                            creador del blog o de los caficultores titulares de las historias.
                        </p>

                        <h4 class="mt-4 mb-4">4. Limitación de Responsabilidad</h4>
                        <p class="text-muted">
                            Café Cosecha y Grano promueve la cultura cafetera y la visibilización del esfuerzo en el campo;
                            sin embargo, no se hace responsable por interrupciones técnicas imprevistas del servidor,
                            ataques informáticos externos o mal uso que los usuarios hagan de sus credenciales de acceso.
                        </p>

                        <h4 class="mt-4 mb-4">5. Modificaciones</h4>
                        <p class="text-muted">
                            Nos reservamos el derecho de modificar estos términos en cualquier momento para adaptarlos a
                            novedades legislativas o mejoras técnicas en el blog. Las modificaciones entrarán en vigor a
                            partir de su publicación en el sitio web.
                        </p>

                        <div class="mt-5 pt-3 border-top text-muted small">
                            <em>Última actualización: Noviembre de 2026. Café Cosecha y Grano. Todos los ©derechos
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
