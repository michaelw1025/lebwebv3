@extends('layouts.app')

@section('content')

        <!-- Title for content -->
        @component('components.content-title')
            @slot('textClass')
            text-primary
            @endslot

            @slot('fontStyle')
            far
            @endslot

            @slot('fontIcon')
            fa-address-book
            @endslot

            @slot('fontSize')
            fa-lg
            @endslot

            @slot('title')
            Cost Centers
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <table class="table table-sm table-hover table-striped table-borderless">
            <thead>
                <tr>
                    <th scope="col">Number</th>
                    <th scope="col">Extension</th>
                    <th scope="col">Description</th>
                    <th scope="col" class="d-none d-md-table-cell">Staff Manager</th>
                </tr>
            </thead>
            <tbody>
                @foreach($costCenters as $costCenter)
                <tr class="clickable-row" data-href="{{route('costCenters.show', ['id' => $costCenter->id])}}">
                    <td>{{$costCenter->number}}</td>
                    <td>{{$costCenter->extension}}</td>
                    <td>{{$costCenter->description}}</td>
                    @foreach($costCenter->employeeStaffManager as $staffManager)
                    <td class="d-none d-md-table-cell"></td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>

@endsection