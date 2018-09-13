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
                Query: All Employee Disciplinary
                @endslot

                @slot('displayExport')
                d-block
                @endslot

                @slot('exportRoute')
                {{Route('export-employee-disciplinary-all')}}
                @endslot
        @endcomponent
                

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <!-- Service Date button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-service-date
                @endslot

                @slot('buttonText')
                Service Date
                @endslot
        @endcomponent
        <!-- Bid Eligible button -->
        @component('components.table-column-toggle')
                 @slot('buttonID')
                toggle-bid-eligible
                @endslot

                @slot('buttonText')
                Bid Eligible
                @endslot
        @endcomponent
        <!-- Shift button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-shift
                @endslot

                @slot('buttonText')
                Shift
                @endslot
        @endcomponent
        <!-- Position button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-position
                @endslot

                @slot('buttonText')
                Position
                @endslot
        @endcomponent
        <!-- Cost Center button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-cost-center
                @endslot

                @slot('buttonText')
                Cost Center
                @endslot
        @endcomponent
        <!-- Team Manager button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-team-manager
                @endslot

                @slot('buttonText')
                Team Manager
                @endslot
        @endcomponent
        <!-- Team Leader button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-team-leader
                @endslot

                @slot('buttonText')
                Team Leader
                @endslot
        @endcomponent

        <!-- Page content goes here -->
        @include('queries.export-tables.disciplinary-all')
            
@endsection