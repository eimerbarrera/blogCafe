 <div class="search__box">
     <div class="container-fluid">

         <div class="row">
             <div class="col-lg-6 m-auto col-md-8 col-sm-11">
                 <img src="{{ asset('assets/img/logo/logo_light2.png') }}" alt="Cosecha y Grano" class="img-fluid mb-5"
                     style="max-height: 320px; width: auto; display: block; margin-left: auto; margin-right: auto;">
             </div>
         </div>

         <div class="row">
             <div class="col-lg-6 m-auto col-md-8 col-sm-11">
                 <div class="search__content">
                     <button type="button" class="search__box-btn-close">
                         <i class="bi bi-x-lg"></i>
                     </button>

                     <!-- Formulario de búsqueda conectado al PostController -->
                     <form class="search__form" action="{{ route('blog.index') }}" method="GET">
                         <input type="search" name="search" class="search__form-input" value="{{ request('search') }}"
                             placeholder="¿Qué deseas buscar en Cosecha y Grano?">

                         <button type="submit" class="search__form-btn-search">Buscar</button>
                     </form>
                 </div>
             </div>
         </div>

     </div>
 </div>
