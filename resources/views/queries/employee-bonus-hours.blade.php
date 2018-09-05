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
                Query: Employee Bonus Hours
                @endslot

                @slot('displayExport')
                d-block
                @endslot

                @slot('exportRoute')
                @if(isset($employees))
                {{Route('export-employee-bonus-hours')}}
                @endif
                @endslot
        @endcomponent
                

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <!-- Page content goes here -->
        @if(isset($employees))
        @include('queries.export-tables.bonus-hours')
        @endif
            
@endsection