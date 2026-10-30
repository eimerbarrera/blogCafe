@extends('layouts.base')

@section('title', 'Editar Post - Cosecha y Grano')

@section('content')

    <section class="banner">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Título y subtítulo a la izquierda -->
                <div class="col-lg-8">
                    <div class="banner__content">
                        <h3 class="banner__title mb-0">
                            Editar Artículo
                        </h3>
                        <p class="banner__subtitle mb-0">
                            Actualiza la información de tu publicación en Cosecha y Grano.
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

    <!-- Formulario de Edición -->
    <section class="">
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

                        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data"
                            class="widget__form">
                            @csrf
                            @method('PUT') <!-- Indicar que es una actualización -->

                            <!-- Título del Post -->
                            <div class="form-group mb-3">
                                <label for="title" class="form-label font-weight-bold">Título del Artículo*</label>
                                <input type="text"
                                    class="form-control widget__form-input @error('title') is-invalid @enderror"
                                    id="title" name="title" value="{{ old('title', $post->title) }}"
                                    placeholder="Ej: El arte del tueste artesanal..." required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Resumen o Extracto -->
                            <div class="form-group mb-3">
                                <label for="summary" class="form-label font-weight-bold">Resumen / Extracto</label>
                                <textarea class="form-control widget__form-input @error('summary') is-invalid @enderror" id="summary" name="summary"
                                    rows="3" placeholder="Breve descripción que aparecerá en la tarjeta del post...">{{ old('summary', $post->summary) }}</textarea>
                                @error('summary')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Categorías -->
                            <div class="form-group mb-3">
                                <label class="form-label font-weight-bold">Categorías* (Selecciona al menos una)</label>
                                <div class="border p-3 rounded">
                                    <div class="row">
                                        @foreach ($categories as $category)
                                            <div class="col-md-4 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="categories[]"
                                                        value="{{ $category->id }}" id="cat_{{ $category->id }}"
                                                        {{ (is_array(old('categories')) && in_array($category->id, old('categories'))) || (!old('categories') && $post->categories->contains($category->id)) ? 'checked' : '' }}>
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
                                <label class="form-label font-weight-bold">Etiquetas* (Selecciona al menos una)</label>
                                <div class="border p-3 rounded">
                                    <div class="row">
                                        @foreach ($tags as $tag)
                                            <div class="col-md-3 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="tags[]"
                                                        value="{{ $tag->id }}" id="tag_{{ $tag->id }}"
                                                        {{ (is_array(old('tags')) && in_array($tag->id, old('tags'))) || (!old('tags') && $post->tags->contains($tag->id)) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="tag_{{ $tag->id }}">
                                                        {{ $tag->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @error('tags')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Imagen Destacada -->
                            <div class="form-group mb-3">
                                <label for="featured_image" class="form-label font-weight-bold">Imagen Destacada</label>
                                @if ($post->featured_image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Imagen actual"
                                            class="img-thumbnail rounded" style="max-height: 120px;">
                                        <p class="small text-muted mb-0">Imagen actual (subir otra solo si deseas
                                            reemplazarla).</p>
                                    </div>
                                @endif
                                <input type="file"
                                    class="form-control widget__form-input @error('featured_image') is-invalid @enderror"
                                    id="featured_image" name="featured_image" accept="image/*">
                                <small class="text-muted">Formatos permitidos: JPEG, PNG, JPG, WEBP (Máx. 5MB).</small>
                                @error('featured_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Contenido Principal -->
                            <div class="form-group mb-3">
                                <label for="content" class="form-label font-weight-bold">Contenido del Artículo*</label>
                                <textarea class="form-control widget__form-input @error('content') is-invalid @enderror" id="content" name="content"
                                    rows="10" placeholder="Escribe el contenido completo de tu artículo aquí..." required>{{ old('content', $post->content) }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Estado del Post y Botones de Acción -->
                            <div class="row align-items-end mb-4">
                                <!-- Estado de Publicación -->
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <label for="status" class="form-label font-weight-bold">Estado de Publicación*</label>
                                    <select name="status" id="status"
                                        class="form-control widget__form-input @error('status') is-invalid @enderror"
                                        required>
                                        <option value="publicado"
                                            {{ old('status', $post->status) == 'publicado' ? 'selected' : '' }}>Publicado
                                        </option>
                                        <option value="borrador"
                                            {{ old('status', $post->status) == 'borrador' ? 'selected' : '' }}>Borrador
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Botones de Acción -->
                                <div class="col-md-8 text-md-end">
                                    <div class="d-flex justify-content-md-end gap-2">
                                        <a href="{{ route('blog.list') }}"
                                            class="btn btn-outline-secondary px-4">Cancelar</a>
                                        <button type="submit" class="btn-custom px-4"
                                            style="max-width: 200px;">Actualizar Post</button>
                                    </div>
                                </div>
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
