<header class="d-flex align-items-center justify-content-between py-3 px-4 bg-white shadow-sm border-bottom">
    <!-- Sección izquierda: Logos -->
    <div class="d-flex align-items-center gap-3">
        <a href="{{ $dev['url'] }}" class="app-brand-link">
            <img src="{{ $dev['logo'] }}" alt="Logo IPSS" class="rounded" style="height: 40px;">
        </a>
        <a href="/" class="app-brand-link">
            <img src="{{ $textos['logo'] }}" alt="Logo Sonkei FC" style="height: 40px;">
        </a>
        <span class="fw-bold text-heading fs-5">{{ $textos['nombre'] }}</span>
    </div>
</header>
