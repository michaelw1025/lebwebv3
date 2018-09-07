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
            fa-user-astronaut
            @endslot

            @slot('fontSize')
            fa-lg
            @endslot

            @slot('title')
            Positions
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <a href="{{route('positions.create')}}" class="btn btn-create mb-3">Create New Position</a>

        <table class="table table-sm table-hover table-striped table-borderless">
            <thead class="bg-header text-light">
                <tr>
                    <th scope="col">Description</th>
                    <th scope="col">Job</th>
                    <th scope="col">Wage Title</th>
                </tr>
            </thead>
            <tbody>
                @foreach($positions as $position)
                <tr class="clickable-row" data-href="{{route('positions.show', ['id' => $position->id])}}">
                    <td>{{$position->description}}</td>
                    @if($position->job->count(0 > 0))
                    @foreach($position->job as $positionJob)
                    <td class="d-none d-md-table-cell">{{$positionJob->description}}</td>
                    @endforeach
                    @else
                    <td class="d-none d-md-table-cell">---</td>
                    @endif
                    @if($position->wageTitle->count(0 > 0))
                    @foreach($position->wageTitle as $positionWageTitle)
                    <td class="d-none d-md-table-cell">{{ucwords($positionWageTitle->description)}}</td>
                    @endforeach
                    @else
                    <td class="d-none d-md-table-cell">---</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>

@endsection