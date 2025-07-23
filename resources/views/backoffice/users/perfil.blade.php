@extends('layouts.app')

@section('title', 'Perfil de Usuario')

@section('content')
@include('backoffice._partials.header', [
    'dev' => [
        'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png',
        'url' => 'https://www.ipss.cl',
        'nombre' => 'Instituto Profesional San Sebastián',
    ],
    'textos' => [
        'logo' => '/assets/imgs/logo_sonkei_v2.webp',
        'nombre' => 'Sonkei FC'
    ]
])

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Configuración /</span> Perfil de Usuario
    </h4>

    @if (session('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <!-- Tarjeta lateral con avatar y datos -->
        <div class="col-md-4">
            <div class="card mb-4 text-center">
                <div class="card-body">
                    <img src="https://cdn-icons-png.flaticon.com/512/12225/12225935.png" alt="Avatar"
                        class="rounded-circle mb-3" width="100">
                    <h5 class="mb-1">{{ $usuario->name }}</h5>
                    <p class="text-muted mb-2">{{ $usuario->email }}</p>
                    <span class="badge bg-label-primary mb-3 text-capitalize">{{ $usuario->role }}</span>

                    <p class="mb-1"><strong>RUT:</strong> {{ $usuario->rut }}</p>
                    <p class="text-success small">Estado: Activo ✅</p>
                </div>
            </div>
        </div>

        <!-- Formulario de edición -->
        <div class="col-md-8">
            <div class="card mb-4">
                <h5 class="card-header">Editar información</h5>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.actualizar') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input id="name" name="name" type="text" value="{{ old('name', $usuario->name) }}"
                                class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input id="email" name="email" type="email" value="{{ old('email', $usuario->email) }}"
                                class="form-control">
                        </div>

                        <hr class="my-4">

                        <h6 class="fw-bold mb-3">🔐 Cambiar contraseña (opcional)</h6>

                        <div class="mb-3">
                            <label for="password" class="form-label">Nueva contraseña</label>
                            <input id="password" name="password" type="password" class="form-control" placeholder="••••••••">
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar nueva contraseña</label>
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                class="form-control" placeholder="••••••••">
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
