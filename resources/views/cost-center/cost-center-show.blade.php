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
            fa-info-circle
            @endslot

            @slot('fontSize')
            fa-lg
            @endslot

            @slot('title')
            Show CC: {{$costCenter->number}} {{$costCenter->extension}}
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="" class="mt-2" id="show-cost-center-form" method="GET" autocomplete="off">
            @csrf

            <div class="form-row mt-4">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-cost-center-number">Number</label>
                    <input type="text" class="form-control" id="show-cost-center-number" name="number" value="{{$costCenter->number}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-cost-center-extension">Extension</label>
                    <input type="text" class="form-control" id="show-cost-center-extension" name="extension" value="{{$costCenter->extension}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-cost-center-description">Description</label>
                    <input type="text" class="form-control" id="show-cost-center-description" name="description" value="{{$costCenter->description}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-cost-center-staff-manager">Staff Manager</label>
                    <input type="text" class="form-control" id="show-cost-center-staff-manager" name="staff_manager" value="@foreach($costCenter->employeeStaffManager as $employeeStaffManager) {{$employeeStaffManager->first_name}} {{$employeeStaffManager->last_name}} @endforeach" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-cost-center-day-team-manager">Day Team Manager</label>
                    <input type="text" class="form-control" id="show-cost-center-day-team-manager" name="day_team_manager" value="@foreach($costCenter->employeeDayTeamManager as $employeeDayTeamManager) {{$employeeDayTeamManager->first_name}} {{$employeeDayTeamManager->last_name}} @endforeach" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-cost-center-night-team-manager">Night Team Manager</label>
                    <input type="text" class="form-control" id="show-cost-center-night-team-manager" name="night_team_manager" value="@foreach($costCenter->employeeNightTeamManager as $employeeNightTeamManager) {{$employeeNightTeamManager->first_name}} {{$employeeNightTeamManager->last_name}} @endforeach" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-cost-center-day-team-leader">Day Team Leader</label>
                    <input type="text" class="form-control" id="show-cost-center-day-team-leader" name="day_team_leader" value="@foreach($costCenter->employeeDayTeamLeader as $employeeDayTeamLeader) {{$employeeDayTeamLeader->first_name}} {{$employeeDayTeamLeader->last_name}} @endforeach" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-cost-center-night-team-leader">Night Team Leader</label>
                    <input type="text" class="form-control" id="show-cost-center-night-team-leader" name="night_team_leader" value="@foreach($costCenter->employeeNightTeamLeader as $employeeNightTeamLeader) {{$employeeNightTeamLeader->first_name}} {{$employeeNightTeamLeader->last_name}} @endforeach" disabled>
                </div>
            </div>

            <a href="{{route('costCenters.edit', $costCenter->id)}}" class="btn btn-edit mt-4">Edit Cost Center</a>
        </form>

@endsection