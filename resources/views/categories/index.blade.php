@extends('layouts.base')

@section('title', 'Gestión de Categorías - Cosecha y Grano')

@section('content')

    <!-- Banner Superior -->
    <section class="banner">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="banner__content">
                        <h3 class="banner__title mb-0">
                            Gestión de Categorías
                        </h3>
                        <p class="banner__subtitle mb-0">
                            Crea, edita y organiza las categorías de nuestro blog de café Cosecha y Grano.
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

    <!-- Contenido Principal del CRUD en una Sola Vista -->
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
                            @isset($categoryEditing)
                                <i class="bi bi-pencil-square text-warning"></i> Editar Categoría
                            @else
                                <i class="bi bi-plus-circle text-primary"></i> Nueva Categoría
                            @endisset
                        </h4>

                        <form
                            action="{{ isset($categoryEditing) ? route('categories.update', $categoryEditing->id) : route('categories.store') }}"
                            method="POST" class="widget__form">
                            @csrf
                            @isset($categoryEditing)
                                @method('PUT')
                            @endisset

                            <!-- Nombre -->
                            <div class="form-group mb-3">
                                <label for="name" class="form-label font-weight-bold">Nombre de la Categoría*</label>
                                <input type="text"
                                    class="form-control widget__form-input @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $categoryEditing->name ?? '') }}"
                                    placeholder="Ej. Caficultores" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Descripción -->
                            <div class="form-group mb-3">
                                <label for="description" class="form-label font-weight-bold">Descripción</label>
                                <textarea class="form-control widget__form-input @error('description') is-invalid @enderror" id="description"
                                    name="description" rows="3" placeholder="Breve reseña de la categoría...">{{ old('description', $categoryEditing->description ?? '') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Botones de Acción -->
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn-custom w-90">
                                    @isset($categoryEditing)
                                        Actualizar
                                    @else
                                        Guardar
                                    @endisset
                                </button>
                                @isset($categoryEditing)
                                    <a href="{{ route('categories.index') }}"
                                        class="btn btn-outline-secondary w-90">Cancelar</a>
                                @endisset
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Columna Derecha: Listado de Categorías -->
                <div class="col-lg-8">
                    <div class="widget p-4 border rounded shadow-sm">
                        <h4 class="mb-4">Listado de Categorías</h4>

                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Slug</th>
                                        <th>Descripción</th>
                                        <th class="text-end">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($categories as $cat)
                                        <tr>
                                            <td>
                                                <strong>{{ $cat->name }}</strong>
                                            </td>
                                            <td><code>{{ $cat->slug }}</code></td>
                                            <td>{{ Str::limit($cat->description, 40) ?: 'Sin descripción' }}</td>
                                            <td class="text-end">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <!-- Botón Editar (Recarga la misma vista con el registro cargado) -->
                                                    <a href="{{ route('categories.edit', $cat->id) }}"
                                                        class="btn btn-sm btn-outline-primary" title="Editar">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>

                                                    <!-- Formulario de Eliminación con SweetAlert2 -->
                                                    <form action="{{ route('categories.destroy', $cat->id) }}"
                                                        method="POST" class="delete-form">
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
                                            <td colspan="4" class="text-center py-4 text-muted">
                                                No hay categorías registradas aún. ¡Crea la primera a la izquierda!
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginación -->
                        <div class="mt-4">
                            {{ $categories->links('pagination::bootstrap-4') }}
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
                        text: "¡Esta categoría será eliminada permanentemente!",
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
