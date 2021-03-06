<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LebWebDev') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('/js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
</head>
<body class="{{in_array(Route::currentRouteName(), array('welcome', 'home', 'login', 'register')) ? 'welcome-body' : ''}}">
    @include('navs.main-nav')

    <section class="container-fluid h-100 border-top">
        <section class="row h-100">


            @yield('content')


        </section>
    </section>

    @include('footers.main-footer')
</body>
</html>