<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
<div class="app-brand px-3 py-3 d-flex justify-content-between align-items-center">
    <a href="/" class="app-brand-link d-flex align-items-center gap-2">
        <span class="app-brand-logo demo">
            <img src="{{ $textos['logo'] }}" alt="Logo" style="height: 32px;">
        </span>
        <span class="app-brand-text demo fw-bold">{{ $textos['nombre'] }}</span>
    </a>

    <!-- Botón toggle siempre visible -->
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large">
        <i class="bx bx-chevrons-left bx-sm"></i>
    </a>
</div>


    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Perfil -->
        <li class="menu-item {{ request()->routeIs('user.perfil') ? 'active' : '' }}">
            <a href="" class="menu-link">
                <i class="menu-icon bx bx-user"></i>
                <div>Mi Perfil</div>
            </a>
        </li>

        <!-- Configuración -->
        <li class="menu-item {{ request()->routeIs('settings') ? 'active' : '' }}">
            <a href="" class="menu-link">
                <i class="menu-icon bx bx-cog"></i>
                <div>Configuración</div>
            </a>
        </li>

        <!-- Cerrar sesión -->
        <li class="menu-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="menu-link btn">
                    <i class="menu-icon bx bx-power-off"></i>
                    <div>Cerrar sesión</div>
                </button>
            </form>
        </li>
    </ul>
</aside>
