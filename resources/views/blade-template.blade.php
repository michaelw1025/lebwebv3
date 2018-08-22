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
                Title
                @endslot

                @slot('displayExport')
                d-block
                @endslot
        @endcomponent
                

                @include('alerts.validation-alert')
                @include('alerts.session-alert')

                <!-- Page content goes here -->
            
@endsection