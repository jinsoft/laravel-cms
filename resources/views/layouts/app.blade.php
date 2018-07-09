<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="{{config('blog.meta.keywords')}}">
    <meta name="description" content="{{config('blog.meta.description')}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title',config('app.name', 'jinblog'))</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- scripts -->
    <script>
        window.Language = '{{ app()->getLocale() }}'
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ])?>
    </script>
    @yield('styles')
</head>
<body style="padding-top: 70px">
<div id="app">
    @include('layouts.navbar')
    <div class="main">
        @yield('content')
    </div>
    @include('layouts.footer')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
