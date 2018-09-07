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
            fa-thermometer-half
            @endslot

            @slot('fontSize')
            fa-lg
            @endslot

            @slot('title')
            Wage Progressions
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <a href="{{route('wageProgressions.create')}}" class="btn btn-create mb-3">Create New Wage Progression</a>

        <table class="table table-sm table-hover table-striped table-borderless">
            <thead class="bg-header text-light">
                <tr>
                    <th scope="col">Month</th>
                </tr>
            </thead>
            <tbody>
                @foreach($wageProgressions as $wageProgression)
                <tr class="clickable-row" data-href="{{route('wageProgressions.show', ['id' => $wageProgression->id])}}">
                    <td>{{$wageProgression->month}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

@endsection