<!DOCTYPE html>
<html lang="es" class="light-style layout-menu-fixed" dir="ltr"
      data-theme="theme-default"
      data-assets-path="/vuexy/assets/"
      data-template="vertical-menu-template-free">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sonkei FC')</title>

    <!-- Vuexy Core CSS -->
    <link rel="stylesheet" href="{{ asset('vuexy/assets/vendor/css/core.css') }}">
    <link rel="stylesheet" href="{{ asset('vuexy/assets/vendor/css/theme-default.css') }}">
    <link rel="stylesheet" href="{{ asset('vuexy/assets/css/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('vuexy/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('vuexy/assets/vendor/fonts/boxicons.css') }}">

    <!-- JS Helpers -->
    <script src="{{ asset('vuexy/assets/vendor/js/helpers.js') }}"></script>
</head>
<body>

    <!-- Vuexy layout -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            {{-- Sidebar --}}
            @include('backoffice._partials.sidebar')

            <div class="layout-page">
                {{-- Si usas navbar aquí va --}}
                {{-- @include('backoffice._partials.navbar') --}}

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>

                    @include('backoffice._partials.footer')
                </div>
            </div>

        </div>
    </div>


    <!-- Vuexy Core JS -->
    <script src="{{ asset('vuexy/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('vuexy/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('vuexy/assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('vuexy/assets/js/main.js') }}"></script>
</body>
</html>
