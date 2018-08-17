@php
    $usersNavArray = array('users.index', 'users.show', 'users.edit');
    $rolesNavArray = array('roles.index', 'roles.show', 'roles.edit', 'roles.create');
    $employeesNavArray = array('employees.index', 'employees.create', 'employees.show', 'employees.edit', 'disciplinaries.index', 'disciplinaries.create', 'disciplinaries.show', 'disciplinaries.edit', 'terminations.index', 'terminations.create', 'terminations.show', 'terminations.edit', 'reductions.index', 'reductions.create', 'reductions.show', 'reductions.edit');
    $queriesNavArray = array();
    $manageNavArray = array();
    $biddingNavArray = array();
    $contractorsNavArray = array();
@endphp
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
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="{{in_array(Route::currentRouteName(), array('welcome', 'home', 'login', 'register')) ? 'welcome-body' : ''}}">
    @include('navs.main-nav')

    <section class="container-fluid h-100 border-top">
        <section class="row h-100">
            <!-- Sidebar -->
            @switch(Request::route()->getPrefix())
                @case('/admin')
                    @include('admin.sidebar')
                    @break
                @case('/hr')
                    @include('hr.sidebar')
                    @break
                @default
            @endswitch

            
            @yield('content')

        </section>
    </section>

    @include('footers.main-footer')
</body>
</html>