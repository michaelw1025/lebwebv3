@extends('layouts.app')

@section('content')
    <section class="container-fluid h-100 border-top">
        <section class="row h-100">

            @include('admin.sidebar')

            <article class="col-10">
                <h2 class="mt-2 text-primary">Title</h2>
                <hr></hr>

                @include('alerts.validation-alert')
                @include('alerts.session-alert')

                <!-- Page content goes here -->

            </article>
            
        </section>
    </section>
@endsection