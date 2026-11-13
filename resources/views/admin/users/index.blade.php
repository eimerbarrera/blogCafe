@extends('layouts.base')

@section('title', 'Gestión de Usuarios - Cosecha y Grano')

@section('content')

    <section class="banner">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="banner__content">
                        <h3 class="banner__title mb-0">
                            Gestión de Usuarios y Roles
                        </h3>
                        <p class="banner__subtitle mb-0">
                            Administra los permisos y roles de usuarios en Cosecha y Grano.
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

    <!-- Listado de Usuarios -->
    <section class="">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 m-auto">

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

                    <div class="widget p-4 border rounded shadow-sm">

                        <!-- Formulario de Búsqueda -->
                        <form action="{{ route('admin.users.index') }}" method="GET" class="mb-4">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control widget__form-input"
                                    placeholder="Buscar por nombre o correo electrónico..." value="{{ request('search') }}">
                                <button class="btn btn-outline-danger" type="submit">
                                    <i class="bi bi-search"></i> Buscar
                                </button>
                                @if (request('search'))
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-danger"
                                        title="Limpiar búsqueda">
                                        <i class="bi bi-x-lg"></i>
                                    </a>
                                @endif
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Rol Actual</th>
                                        <th>Último Acceso</th> <!-- NUEVO (Paso 5.2) -->
                                        <th>Último Post</th> <!-- NUEVO (Paso 5.2) -->
                                        <th>Cambiar Rol</th>
                                        <th>Acciones</th> <!-- NUEVO (Paso 5.1 Papelera) -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $usuario)
                                        <tr>
                                            <td>
                                                <strong>{{ $usuario->name }}</strong>
                                            </td>
                                            <td>{{ $usuario->email }}</td>
                                            <td>
                                                <span
                                                    class="badge
                            @if ($usuario->role == 'admin') bg-danger
                            @elseif($usuario->role == 'editor') bg-success
                            @else bg-secondary @endif">
                                                    {{ ucfirst($usuario->role) }}
                                                </span>
                                            </td>
                                            <!-- NUEVO: Mostrar Último Acceso (Paso 5.2) -->
                                            <td>
                                                {{ $usuario->last_login_at ? $usuario->last_login_at->format('d/m/Y H:i') : 'Nunca' }}
                                            </td>
                                            <!-- NUEVO: Mostrar Último Post Publicado (Paso 5.2) -->
                                            <td>
                                                {{ method_exists($usuario, 'lastPostDate') ? $usuario->lastPostDate() : 'Sin publicaciones' }}
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.users.updateRole', $usuario->id) }}"
                                                    method="POST" class="d-flex gap-2 align-items-center">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="role" class="form-select form-select-sm"
                                                        style="width: 140px;">
                                                        <option value="user"
                                                            {{ $usuario->role == 'user' ? 'selected' : '' }}>Usuario
                                                        </option>
                                                        <option value="editor"
                                                            {{ $usuario->role == 'editor' ? 'selected' : '' }}>Editor
                                                        </option>
                                                        <option value="admin"
                                                            {{ $usuario->role == 'admin' ? 'selected' : '' }}>Administrador
                                                        </option>
                                                    </select>
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-primary">Actualizar</button>
                                                </form>
                                            </td>
                                            <!-- NUEVO: Acciones de Papelera / Soft Delete (Paso 5.1) -->
                                            <td>
                                                @if ($usuario->trashed())
                                                    <form action="{{ route('admin.users.restore', $usuario->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success"
                                                            title="Restaurar usuario">
                                                            <i class="bi bi-arrow-counterclockwise"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.users.destroy', $usuario->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            title="Enviar a papelera">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginación -->
                        <div class="row">
                            <div class="col-lg-12">
                                {{ $users->links('pagination::bootstrap-4') }}
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <!--newsletter-->
    @include('partials.newslettre')

@endsection
