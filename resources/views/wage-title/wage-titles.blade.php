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
            fa-funnel-dollar
            @endslot

            @slot('fontSize')
            fa-lg
            @endslot

            @slot('title')
            Wage Titles
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <a href="{{route('wageTitles.create')}}" class="btn btn-create mb-3">Create New Wage Title</a>

        <table class="table table-sm table-hover table-striped table-borderless">
            <thead class="bg-header text-light">
                <tr>
                    <th scope="col">Description</th>
                    @foreach($wageTitles as $wageTitle)
                    @if($loop->first)
                    @foreach($wageTitle->wageProgression as $wageTitleWageProgression)
                    <th scope="col">{{$wageTitleWageProgression->month}}</th>
                    @endforeach
                    @endif
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($wageTitles as $wageTitle)
                <tr class="clickable-row" data-href="{{route('wageTitles.show', ['id' => $wageTitle->id])}}">
                    <td>{{ucwords($wageTitle->description)}}</td>
                    @foreach($wageTitle->wageProgression as $wageTitleWageProgression)
                    <td>{{$wageTitleWageProgression->pivot->amount}}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>

@endsection