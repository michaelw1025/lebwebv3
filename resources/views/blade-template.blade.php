@extends('layouts.app')

@section('content')

            <article class="col-10  main-content-article">
                <h2 class="mt-2 text-primary">Title</h2>
                <hr></hr>

                @include('alerts.validation-alert')
                @include('alerts.session-alert')

                <!-- Page content goes here -->

            </article>
            
@endsection