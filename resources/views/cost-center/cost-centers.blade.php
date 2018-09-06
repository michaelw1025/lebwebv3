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

        <a href="{{route('costCenters.create')}}" class="btn btn-create mb-3">Create New Cost Center</a>

        <table class="table table-sm table-hover table-striped table-borderless">
            <thead class="bg-header text-light">
                <tr>
                    <th scope="col">Number</th>
                    <th scope="col">Extension</th>
                    <th scope="col">Description</th>
                    <th scope="col" class="d-none d-md-table-cell">Staff Manager</th>
                    <th scope="col" class="d-none d-md-table-cell">Day Team Manager</th>
                    <th scope="col" class="d-none d-md-table-cell">Night Team Manager</th>
                    <th scope="col" class="d-none d-md-table-cell">Day Team Leader</th>
                    <th scope="col" class="d-none d-md-table-cell">Night Team Leader</th>
                </tr>
            </thead>
            <tbody>
                @foreach($costCenters as $costCenter)
                <tr class="clickable-row" data-href="{{route('costCenters.show', ['id' => $costCenter->id])}}">
                    <td>{{$costCenter->number}}</td>
                    <td>{{$costCenter->extension}}</td>
                    <td>{{$costCenter->description}}</td>
                    @if($costCenter->employeeStaffManager->count(0 > 0))
                    @foreach($costCenter->employeeStaffManager as $employeeStaffManager)
                    <td class="d-none d-md-table-cell">{{$employeeStaffManager->first_name}} {{$employeeStaffManager->last_name}}</td>
                    @endforeach
                    @else
                    <td class="d-none d-md-table-cell">---</td>
                    @endif
                    @if($costCenter->employeeDayTeamManager->count(0 > 0))
                    @foreach($costCenter->employeeDayTeamManager as $employeeDayTeamManager)
                    <td class="d-none d-md-table-cell">{{$employeeDayTeamManager->first_name}} {{$employeeDayTeamManager->last_name}}</td>
                    @endforeach
                    @else
                    <td class="d-none d-md-table-cell">---</td>
                    @endif
                    @if($costCenter->employeeNightTeamManager->count(0 > 0))
                    @foreach($costCenter->employeeNightTeamManager as $employeeNightTeamManager)
                    <td class="d-none d-md-table-cell">{{$employeeNightTeamManager->first_name}} {{$employeeNightTeamManager->last_name}}</td>
                    @endforeach
                    @else
                    <td class="d-none d-md-table-cell">---</td>
                    @endif
                    @if($costCenter->employeeDayTeamLeader->count(0 > 0))
                    @foreach($costCenter->employeeDayTeamLeader as $employeeDayTeamLeader)
                    <td class="d-none d-md-table-cell">{{$employeeDayTeamLeader->first_name}} {{$employeeDayTeamLeader->last_name}}</td>
                    @endforeach
                    @else
                    <td class="d-none d-md-table-cell">---</td>
                    @endif
                    @if($costCenter->employeeNightTeamLeader->count(0 > 0))
                    @foreach($costCenter->employeeNightTeamLeader as $employeeNightTeamLeader)
                    <td class="d-none d-md-table-cell">{{$employeeNightTeamLeader->first_name}} {{$employeeNightTeamLeader->last_name}}</td>
                    @endforeach
                    @else
                    <td class="d-none d-md-table-cell">---</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>

@endsection