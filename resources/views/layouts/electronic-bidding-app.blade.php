<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="show-bids-background">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LebWebDev') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('/js/bid.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('/css/bid.css') }}" rel="stylesheet">

</head>
<body class="bg-transparent">
@if(isset($employee))
<i id="employee-badge-verification">{{$employee->id}}</i>
@endif
    @include('electronic-bidding.includes.add-bid-modal')
    @include('electronic-bidding.includes.add-duplicate-bid-modal')
    @include('electronic-bidding.includes.max-number-of-bids-modal')
    @include('electronic-bidding.includes.bidder-not-eligible-modal')
    @include('electronic-bidding.includes.badge-numbers-do-not-match-modal')
    @include('electronic-bidding.includes.remove-bid-modal')
    @include('electronic-bidding.includes.submit-bids-modal')

    @include('electronic-bidding.includes.timer-form')
    @include('navs.electronic-bidding-nav')
    @yield('content')
</body>
</html>