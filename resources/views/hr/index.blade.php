@extends('layouts.app')

@section('content')

        <h2 class="mt-2 text-primary"></i>Human Resources</h2>
        <hr></hr>
        <!-- Title for content -->
        @component('components.content-title')
            @slot('textClass')
            text-primary
            @endslot

            @slot('fontStyle')

            @endslot

            @slot('fontIcon')

            @endslot

            @slot('fontSize')

            @endslot

            @slot('title')
            Human Resources
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

@endsection