<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin_assets/images/favicon.jpeg') }}">
    <title>Q8votes</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/custom.css') }}" rel="stylesheet">

    <!-- Scripts -->
</head>

<body>
    <div id="app">
        <main>
            @yield('content')
            <script src="{{ asset('admin_assets/node_modules/jquery/dist/jquery.min.js') }}"></script>
            <!-- Bootstrap tether Core JavaScript -->
            <script src="{{ asset('admin_assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
            <!-- slimscrollbar scrollbar JavaScript -->
            <script src="{{ asset('admin_assets/js/perfect-scrollbar.jquery.min.js') }}"></script>

            @yield('js')
        </main>
    </div>
</body>

</html>