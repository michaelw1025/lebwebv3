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
            fa-map-signs
            @endslot

            @slot('fontSize')
            fa-lg
            @endslot

            @slot('title')
            Jobs
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <a href="{{route('jobs.create')}}" class="btn btn-create mb-3">Create New Job</a>

        <table class="table table-sm table-hover table-striped table-borderless">
            <thead class="bg-header text-light">
                <tr>
                    <th scope="col">Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobs as $job)
                <tr class="clickable-row" data-href="{{route('jobs.show', ['id' => $job->id])}}">
                    <td>{{$job->description}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

@endsection