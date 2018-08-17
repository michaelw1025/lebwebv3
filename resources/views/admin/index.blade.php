@extends('layouts.app')

@section('content')

    <article class="col-8 xol-xs-9 col-sm-10 main-content-article">
        <h2 class="mt-2 text-primary"></i>Admin</h2>
        <hr></hr>

        @include('alerts.validation-alert')
        @include('alerts.session-alert')
        
    </article>

@endsection