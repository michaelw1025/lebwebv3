@extends('layouts.app')

@section('content')

                <!-- Title for content -->
        @component('components.content-title')
                @slot('textClass')
                text-primary
                @endslot

                @slot('fontStyle')
                fas
                @endslot

                @slot('fontIcon')
                sa-search
                @endslot

                @slot('fontSize')
                fa-lg
                @endslot

                @slot('title')
                Query: Employees Alphabetical Hourly
                @endslot

                @slot('displayExport')
                d-block
                @endslot

                @slot('exportRoute')
                {{route('export-employee-alphabetical-hourly')}}
                @endslot
        @endcomponent
                

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <!-- SSN button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-ssn
                @endslot

                @slot('buttonText')
                SSN
                @endslot
        @endcomponent
        <!-- Birth Date button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-birth-date
                @endslot

                @slot('buttonText')
                Birth Date
                @endslot
        @endcomponent
        <!-- Hire Date button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-hire-date
                @endslot

                @slot('buttonText')
                Hire Date
                @endslot
        @endcomponent
        <!-- Service Date button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-service-date
                @endslot

                @slot('buttonText')
                Service Date
                @endslot
        @endcomponent
        <!-- Address button -->
        @component('components.table-column-toggle')
                 @slot('buttonID')
                toggle-address
                @endslot

                @slot('buttonText')
                Address
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
        @include('queries.export-tables.alphabetical')
            
@endsection