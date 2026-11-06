@extends('layouts.base')

@section('title', 'Gestión de Etiquetas - Café Cosecha y Grano')

@section('content')

    <!-- Banner Superior -->
    <section class="banner">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="banner__content">
                        <h3 class="banner__title mb-0">
                            Gestión de Etiquetas
                        </h3>
                        <p class="banner__subtitle mb-0">
                            Organiza y administra los tags de las publicaciones en Café Cosecha y Grano.
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

    <!-- Contenido Principal del CRUD de Etiquetas -->
    <section class="">
        <div class="container-fluid">

            <!-- Mensajes de Éxito o Error -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <!-- Columna Izquierda: Formulario (Crear o Editar) -->
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="widget p-4 border rounded shadow-sm">
                        <h4 class="mb-4">
                            @isset($tagEditing)
                                <i class="bi bi-pencil-square text-warning"></i> Editar Etiqueta
                            @else
                                <i class="bi bi-plus-circle text-primary"></i> Nueva Etiqueta
                            @endisset
                        </h4>

                        <form
                            action="{{ isset($tagEditing) ? route('tags.update', $tagEditing->id) : route('tags.store') }}"
                            method="POST" class="widget__form">
                            @csrf
                            @isset($tagEditing)
                                @method('PUT')
                            @endisset

                            <!-- Nombre -->
                            <div class="form-group mb-3">
                                <label for="name" class="form-label font-weight-bold">Nombre de la Etiqueta*</label>
                                <input type="text"
                                    class="form-control widget__form-input @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $tagEditing->name ?? '') }}"
                                    placeholder="Ej. Caficultor" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Botones de Acción -->
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn-custom w-90">
                                    @isset($tagEditing)
                                        Actualizar
                                    @else
                                        Guardar
                                    @endisset
                                </button>
                                @isset($tagEditing)
                                    <a href="{{ route('tags.index') }}" class="btn btn-outline-secondary w-90">Cancelar</a>
                                @endisset
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Columna Derecha: Listado de Etiquetas -->
                <div class="col-lg-8">
                    <div class="widget p-4 border rounded shadow-sm">
                        <h4 class="mb-4">Listado de Etiquetas</h4>

                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Slug</th>
                                        <th class="text-end">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($tags as $tag)
                                        <tr>
                                            <td>
                                                <strong>{{ $tag->name }}</strong>
                                            </td>
                                            <td><code>{{ $tag->slug }}</code></td>
                                            <td class="text-end">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <!-- Botón Editar -->
                                                    <a href="{{ route('tags.edit', $tag->id) }}"
                                                        class="btn btn-sm btn-outline-primary" title="Editar">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>

                                                    <!-- Formulario de Eliminación con SweetAlert2 -->
                                                    <form action="{{ route('tags.destroy', $tag->id) }}" method="POST"
                                                        class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                            title="Eliminar">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-4 text-muted">
                                                No hay etiquetas registradas aún. ¡Crea la primera a la izquierda!
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginación -->
                        <div class="mt-4">
                            {{ $tags->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- SweetAlert2 para Confirmaciones en Español -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "¡Esta etiqueta será eliminada permanentemente!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Sí, ¡eliminar!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

    <!--newsletter-->
    @include('partials.newslettre')

@endsection
