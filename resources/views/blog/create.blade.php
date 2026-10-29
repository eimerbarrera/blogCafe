@extends('layouts.base')

@section('title', 'Crear Nuevo Post - Cosecha y Grano')

@section('content')

    <section class="banner">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Título y subtítulo a la izquierda -->
                <div class="col-lg-8">
                    <div class="banner__content">
                        <h3 class="banner__title mb-0">
                            Crear Nuevo Artículo
                        </h3>
                        <p class="banner__subtitle mb-0">
                            Comparte tus historias, recetas y pasión por el café de especialidad.
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

    <!-- Formulario de Creación -->
    <section class="blog blog--create">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 m-auto">
                    <div class="widget p-4 border rounded shadow-sm">

                        <!-- Mostrar errores de validación generales si los hay -->
                        @if ($errors->any())
                            <div class="alert alert-danger mb-4">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data"
                            class="widget__form">
                            @csrf

                            <!-- Título del Post -->
                            <div class="form-group mb-3">
                                <label for="title" class="form-label font-weight-bold">Título del Artículo*</label>
                                <input type="text"
                                    class="form-control widget__form-input @error('title') is-invalid @enderror"
                                    id="title" name="title" value="{{ old('title') }}"
                                    placeholder="Ej: El arte del tueste artesanal..." required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Resumen o Extracto -->
                            <div class="form-group mb-3">
                                <label for="summary" class="form-label font-weight-bold">Resumen / Extracto</label>
                                <textarea class="form-control widget__form-input @error('summary') is-invalid @enderror" id="summary" name="summary"
                                    rows="3" placeholder="Breve descripción que aparecerá en la tarjeta del post...">{{ old('summary') }}</textarea>
                                @error('summary')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Categorías -->
                            <div class="form-group mb-3">
                                <label class="form-label font-weight-bold">Categorías* (Selecciona al menos una)</label>
                                <div class="border p-3 rounded bg-light text-dark">
                                    <div class="row">
                                        @foreach ($categories as $category)
                                            <div class="col-md-4 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="categories[]"
                                                        value="{{ $category->id }}" id="cat_{{ $category->id }}"
                                                        {{ is_array(old('categories')) && in_array($category->id, old('categories')) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="cat_{{ $category->id }}">
                                                        {{ $category->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @error('categories')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Etiquetas (Tags) -->
                            <div class="form-group mb-3">
                                <label class="form-label font-weight-bold">Etiquetas (Opcional)</label>
                                <div class="border p-3 rounded bg-light text-dark">
                                    <div class="row">
                                        @foreach ($tags as $tag)
                                            <div class="col-md-3 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="tags[]"
                                                        value="{{ $tag->id }}" id="tag_{{ $tag->id }}"
                                                        {{ is_array(old('tags')) && in_array($tag->id, old('tags')) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="tag_{{ $tag->id }}">
                                                        {{ $tag->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Imagen Destacada -->
                            <div class="form-group mb-3">
                                <label for="featured_image" class="form-label font-weight-bold">Imagen Destacada</label>
                                <input type="file"
                                    class="form-control widget__form-input @error('featured_image') is-invalid @enderror"
                                    id="featured_image" name="featured_image" accept="image/*">
                                <small class="text-muted">Formatos permitidos: JPEG, PNG, JPG, WEBP (Máx. 2MB).</small>
                                @error('featured_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Contenido Principal -->
                            <div class="form-group mb-3">
                                <label for="content" class="form-label font-weight-bold">Contenido del Artículo*</label>
                                <textarea class="form-control widget__form-input @error('content') is-invalid @enderror" id="content" name="content"
                                    rows="10" placeholder="Escribe el contenido completo de tu artículo aquí..." required>{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Estado del Post -->
                            <div class="form-group mb-4">
                                <label for="status" class="form-label font-weight-bold">Estado de Publicación*</label>
                                <select name="status" id="status"
                                    class="form-control widget__form-input @error('status') is-invalid @enderror" required>
                                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>
                                        Publicado</option>
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Borrador
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Botones de Acción -->
                            <div class="widget__form-btn d-flex gap-2">
                                <button type="submit" class="btn-custom flex-grow-1">Guardar y Publicar</button>
                                <a href="{{ route('blog.list') }}" class="btn btn-outline-secondary">Cancelar</a>
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
