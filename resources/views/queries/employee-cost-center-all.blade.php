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
                Query:  All Cost Centers
                @endslot

                @slot('displayExport')
                d-block
                @endslot

                @slot('exportRoute')
                {{Route('export-employee-cost-center-all')}}
                @endslot
        @endcomponent
                

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <!-- Page content goes here -->
        @include('queries.export-tables.cost-center-all')
            
@endsection