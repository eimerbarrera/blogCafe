@extends('layouts.base')

@section('title', 'Aviso Legal - Café Cosecha y Grano')

@section('content')

    <!-- Banner Superior -->
    <section class="banner">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="banner__content">
                        <h3 class="banner__title mb-0">
                            Aviso Legal e Identidad Digital
                        </h3>
                        <p class="banner__subtitle mb-0">
                            Información corporativa y legal sobre los titulares y el funcionamiento de Café Cosecha y Grano.
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

    <!-- Contenido de Aviso Legal -->
    <section class="mb-60">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="widget p-5 border rounded shadow-sm">

                        <h4 class="mb-4">1. Datos Identificativos del Titular</h4>
                        <p class="text-muted">
                            En cumplimiento con el deber de información recogido en las normativas digitales y de comercio
                            electrónico, se detallan a continuación los datos del titular de este sitio web:
                        </p>
                        <ul class="text-muted mb-4">
                            <li><strong>Nombre del Proyecto / Blog:</strong> Café Cosecha y Grano</li>
                            <li><strong>Sitio Web Oficial:</strong> <code>https://cosechaygrano.com</code></li>
                            <li><strong>Propósito Principal:</strong> Divulgación de la cultura cafetera, visibilización de
                                los procesos de cultivo y reconocimiento al esfuerzo de los caficultores.</li>
                            <li><strong>Contacto Técnico y Editorial:</strong> A través de los canales oficiales habilitados
                                en la plataforma.</li>
                        </ul>

                        <h4 class="mt-4 mb-4">2. Objeto del Sitio Web</h4>
                        <p class="text-muted">
                            El presente sitio web ha sido creado con el propósito de ofrecer un espacio de lectura, debate,
                            colaboración editorial y difusión cultural en torno al café, permitiendo a los
                            usuarios registrarse, interactuar mediante roles asignados (usuarios, editores y
                            administradores) y acceder a artículos especializados.
                        </p>

                        <h4 class="mt-4 mb-4">3. Propiedad Intelectual e Industrial</h4>
                        <p class="text-muted">
                            Todos los elementos que conforman <strong>Café Cosecha y Grano</strong>, incluyendo código
                            fuente, diseños gráficos, plantillas (estilo NoonPost), logotipos, textos, fotografías y
                            material audiovisual que visibilizan el trabajo en el campo cafatero, están protegidos por
                            derechos de autor. Su uso, copia o distribución no autorizada constituye una infracción de los
                            derechos de propiedad intelectual.
                        </p>

                        <h4 class="mt-4 mb-4">4. Exclusión de Garantías y Responsabilidad</h4>
                        <p class="text-muted">
                            El titular no se hace responsable, en ningún caso, de los daños y perjuicios de cualquier
                            naturaleza que pudieran ocasionar errores u omisiones en los contenidos, la falta de
                            disponibilidad del portal o la transmisión de virus o programas maliciosos a pesar de haber
                            adoptado las medidas tecnológicas necesarias para evitarlo.
                        </p>

                        <h4 class="mt-4 mb-4">5. Legislación Aplicable</h4>
                        <p class="text-muted">
                            La relación entre Café Cosecha y Grano y los usuarios, editores y visitantes del sitio se regirá
                            por la normativa vigente aplicable en la materia, sometiéndose a los juzgados y tribunales
                            competentes para cualquier controversia derivada del uso de este sitio web.
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
