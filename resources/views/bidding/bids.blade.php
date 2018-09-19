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
                fa-receipt
                @endslot

                @slot('fontSize')
                fa-lg
                @endslot
                
                @slot('title')
                Bidding
                @endslot

                @slot('displayExport')
                d-none
                @endslot

                @slot('exportRoute')

                @endslot
        @endcomponent
                

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <!-- Page content goes here -->
        <a href="{{route('bidding.create')}}" class="btn btn-create mb-3">Create New Bid</a>
            
@endsection