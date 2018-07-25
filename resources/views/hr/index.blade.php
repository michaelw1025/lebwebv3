@extends('layouts.app')

@section('content')

    @include('hr.sidebar')

    <article class="col-10  main-content-article">
        <h2 class="mt-2 text-primary"></i>Human Resources</h2>
        <hr></hr>

        @include('alerts.validation-alert')
        @include('alerts.session-alert')
        
    </article>

@endsection