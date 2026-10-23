<!doctype html>
<html lang="es">

<head>
    @include('partials.head')
</head>

<body>
    <!--loading -->
    @include('partials.loading')
    <!--/-->

    <!-- Header -->
    @include('partials.header')
    <!--/-->

    <main class="main">

        <!--about-us-->
        <section class="m-top mb-10">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-9 m-auto">
                        <div class="about-us">
                            <!-- Imagen adaptada con la ruta dinámica de Laravel -->
                            <div class="about-us__image">
                                <img src="{{ asset('assets/img/pic/about-us.jpg') }}"
                                    alt="Cosecha y Grano - Nuestra Historia" class="about-us__img">
                            </div>
                            <div class="about-us__description">
                                <p class="about-us__description-text">
                                    Bienvenidos a <strong>Cosecha y Grano</strong>, un espacio digital creado con el
                                    corazón en las montañas y la pasión en cada taza. Aquí nos dedicamos a explorar,
                                    contar y compartir las historias reales detrás del café, conectando
                                    el trabajo diario de los caficultores con quienes valoran una taza excepcional.
                                </p>
                                <p class="about-us__description-text">
                                    Creemos firmemente que cada grano guarda un viaje único: desde la selección
                                    cuidadosa de la semilla en la tierra fértil, pasando por el esmero de la cosecha
                                    manual y el secado artesanal, hasta llegar al proceso de tueste que despierta
                                    aromas y sabores inigualables. Nuestro propósito es hacer visible ese esfuerzo
                                    invisible.
                                </p>
                                <p class="about-us__description-text">
                                    Este blog nace como una ventana abierta a la cultura del café. Queremos compartir
                                    tanto con los curiosos como con los baristas experimentados, entrevistas con caficultores
                                    y todo lo que necesitas saber para entender por qué el café es todo un arte.
                                </p>

                                <!-- Frase célebre cafetera adaptada -->
                                <div class="about-us__qoute">
                                    <i class="bi bi-quote about-us__qoute-icon"></i>
                                    <h3 class="about-us__qoute-item">
                                        "Detrás de cada taza de café hay una historia de esfuerzo, tierra, paciencia y
                                        comunidad."
                                    </h3>
                                    <small class="about-us__qoute-author">Cosecha y Grano.</small>
                                </div>

                                <p class="about-us__description-text">
                                    Nos mueve la transparencia y el comercio justo. Por eso, en Cosecha y Grano no solo
                                    leemos sobre café, sino que promovemos una cultura de consumo consciente, donde cada
                                    taza que disfrutas apoya directamente el desarrollo sostenible de las familias
                                    caficultoras que entregan su vida al campo.
                                </p>
                                <p class="about-us__description-text">
                                    Te invitamos a recorrer nuestras publicaciones, unirte a nuestra comunidad en redes
                                    sociales y ser parte activa de esta gran familia cafetera. ¡Gracias por acompañarnos
                                    en este viaje desde la semilla hasta la taza!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--newslettre-->
        @include('partials.newslettre')

    </main>

    <!--footer-->
    @include('partials.footer')

    <!--Search-form-->
    <div class="search__box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 m-auto col-md-8 col-sm-11">
                    <div class="search__content ">
                        <button type="button" class="search__box-btn-close">
                            <i class="bi bi-x-lg"></i>
                        </button>
                        <form class="search__form" action="search-page.html">
                            <input type="search" class="search__form-input" value=""
                                placeholder="What are you looking for?">
                            <button type="submit" class="search__form-btn-search">search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.js')

</body>

</html>
