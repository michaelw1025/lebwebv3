@extends('layouts.app')

@section('content')

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

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')

            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

@endsection