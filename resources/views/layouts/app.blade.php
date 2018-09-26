@php
    $usersNavArray = array('users.index', 'users.show', 'users.edit');
    $rolesNavArray = array('roles.index', 'roles.show', 'roles.edit', 'roles.create');
    $employeesNavArray = array('employees.index', 'employees.create', 'employees.show', 'employees.edit', 'disciplinaries.index', 'disciplinaries.create', 'disciplinaries.show', 'disciplinaries.edit', 'terminations.index', 'terminations.create', 'terminations.show', 'terminations.edit', 'reductions.index', 'reductions.create', 'reductions.show', 'reductions.edit');
    $queriesNavArray = array('queries.employee-alphabetical-hourly', 'queries.employee-alphabetical-salary', 'queries.employee-anniversary-by-month', 'queries.employee-anniversary-by-quarter', 'queries.employee-birthday', 'queries.employee-seniority', 'queries.employee-wage-progression', 'queries.employee-cost-center-all', 'queries.employee-cost-center-individual', 'queries.employee-disciplinary-all');
    $manageNavArray = array('costCenters.index', 'costCenters.create', 'costCenters.store', 'costCenters.edit', 'costCenters.update', 'costCenters.destroy', 'jobs.index', 'jobs.create', 'jobs.store', 'jobs.edit', 'jobs.update', 'jobs.destroy', 'positions.index', 'positions.create', 'positions.store', 'positions.edit', 'positions.update', 'positions.destroy', 'shifts.index', 'shifts.create', 'shifts.store', 'shifts.edit', 'shifts.update', 'shifts.destroy', 'wageProgressions.index', 'wageProgressions.create', 'wageProgressions.store', 'wageProgressions.edit', 'wageProgressions.update', 'wageProgressions.destroy', 'wageTitles.index', 'wageTitles.create', 'wageTitles.store', 'wageTitles.edit', 'wageTitles.update', 'wageTitles.destroy');
    $biddingNavArray = array('bids.index', 'bids.create', 'bids.show', 'bids.edit');
    $contractorsNavArray = array('contractors.index', 'contractors.create', 'contractors.store', 'contractors.show', 'contractors.edit', 'contractors.update', 'contractors.destroy', 'contractorTrainings.index', 'contractorTrainings.create', 'contractorTrainings.store', 'contractorTrainings.show', 'contractorTrainings.edit', 'contractorTrainings.update', 'contractorTrainings.destroy');
    $notificationArray = array('user-notifications');
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
    <script src="{{ mix('/js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
</head>
<body class="{{in_array(Route::currentRouteName(), array('welcome', 'home', 'login', 'register')) ? 'welcome-body' : ''}}">
    @inject('notifications', 'App\Services\UserNotificationService')

    @include('navs.main-nav')

    <section class="container-fluid h-100 border-top">
        <section class="row h-100">
            <!-- Sidebar -->
            @include('sidebars.user-sidebar', ['userNotifications' => $notifications->getUnReadNotifications()])

            <article class="col-8 xol-xs-9 col-sm-10 main-content-article">
            @yield('content')
            </article>

        </section>
    </section>

    @include('footers.main-footer')
</body>
</html>