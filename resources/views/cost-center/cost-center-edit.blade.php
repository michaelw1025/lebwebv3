@extends('layouts.app')

@section('content')

        <!-- Title for content -->
        @component('components.content-title')
            @slot('textClass')
            text-edit
            @endslot

            @slot('fontStyle')
            far
            @endslot

            @slot('fontIcon')
            fa-edit
            @endslot

            @slot('fontSize')
            fa-lg
            @endslot

            @slot('title')
            Edit CC: {{$costCenter->number}} {{$costCenter->extension}}
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{Route('costCenters.update', $costCenter->id)}}" class="mt-2" id="edit-cost-center-form" method="POST" autocomplete="off">
            @csrf
            @method('Patch')
            <a href="{{route('costCenters.show', ['id' => $costCenter->id])}}" class="h3 text-primary my-4"><i class="fas fa-arrow-left"></i> Return To Show: {{$costCenter->number}} {{$costCenter->extension}}</a>

            <p class="text-danger mt-4">@component('components.required-icon')@endComponent indicates a required field</p>

            <div class="form-row mt-4">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-cost-center-number">Number @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('number') ? 'is-invalid' : ''}}" id="edit-cost-center-number" name="number" value="{{old('number') ? old('number') : $costCenter->number}}">
                    @if($errors->has('number'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('number')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-cost-center-extension">Extension</label>
                    <select class="custom-select {{$errors->has('extension') ? 'is-invalid' : ''}}" id="edit-cost-center-extension" name="extension">
                        @if(!old('extension'))
                        <option value="{{$costCenter->extension}}" selected>{{$costCenter->extension}}</option>
                        @endif
                        <option value=""></option>
                        <option {{old('extension') ? (old('extension') == 'a' ? 'selected' : '') : ''}} value="a">a</option>
                        <option {{old('extension') ? (old('extension') == 'b' ? 'selected' : '') : ''}} value="b">b</option>
                        <option {{old('extension') ? (old('extension') == 'c' ? 'selected' : '') : ''}} value="c">c</option>
                        <option {{old('extension') ? (old('extension') == 'd' ? 'selected' : '') : ''}} value="d">d</option>
                        <option {{old('extension') ? (old('extension') == 'e' ? 'selected' : '') : ''}} value="e">e</option>
                        <option {{old('extension') ? (old('extension') == 'f' ? 'selected' : '') : ''}} value="f">f</option>
                        <option {{old('extension') ? (old('extension') == 'g' ? 'selected' : '') : ''}} value="g">g</option>
                        <option {{old('extension') ? (old('extension') == 'h' ? 'selected' : '') : ''}} value="h">h</option>
                        <option {{old('extension') ? (old('extension') == 'i' ? 'selected' : '') : ''}} value="i">i</option>
                        <option {{old('extension') ? (old('extension') == 'j' ? 'selected' : '') : ''}} value="j">j</option>
                    </select>
                    @if($errors->has('extension'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('extension')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-cost-center-description">Description @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" id="edit-cost-center-description" name="description" value="{{old('description') ? old('description') : $costCenter->description}}">
                    @if($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('description')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-cost-center-staff-manager">Staff Manager @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('staff_manager') ? 'is-invalid' : ''}}" id="edit-cost-center-staff-manager" name="staff_manager">
                    @if(!old('staff_manager') && $costCenter->employeeStaffManager->count() > 0)
                    @foreach($costCenter->employeeStaffManager as $employeeStaffManager)
                    <option selected value="{{$employeeStaffManager->pivot->employee_id}}">{{$employeeStaffManager->first_name}} {{$employeeStaffManager->last_name}}</option>
                    @endforeach
                    @endif
                    <option value=""></option>
                    @foreach($supervisors as $supervisor)
                    <option {{old('staff_manager') ? (old('staff_manager') == $supervisor->id ? 'selected' : '') : ''}} value="{{$supervisor->id}}">{{$supervisor->first_name}} {{$supervisor->last_name}}</option>
                    @endforeach
                    </select>
                    @if($errors->has('staff_manager'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('staff_manager')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-cost-center-day-team-manager">Day Team Manager @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('day_team_manager') ? 'is-invalid' : ''}}" id="edit-cost-center-day-team-manager" name="day_team_manager">
                    @if(!old('day_team_manager') && $costCenter->employeeDayTeamManager->count() > 0)
                    @foreach($costCenter->employeeDayTeamManager as $employeeDayTeamManager)
                    <option selected value="{{$employeeDayTeamManager->pivot->employee_id}}">{{$employeeDayTeamManager->first_name}} {{$employeeDayTeamManager->last_name}}</option>
                    @endforeach
                    @endif
                    <option value=""></option>
                    @foreach($supervisors as $supervisor)
                    <option {{old('day_team_manager') ? (old('day_team_manager') == $supervisor->id ? 'selected' : '') : ''}} value="{{$supervisor->id}}">{{$supervisor->first_name}} {{$supervisor->last_name}}</option>
                    @endforeach
                    </select>
                    @if($errors->has('day_team_manager'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('day_team_manager')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-cost-center-night-team-manager">Night Team Manager @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('night_team_manager') ? 'is-invalid' : ''}}" id="edit-cost-center-night-team-manager" name="night_team_manager">
                    @if(!old('night_team_manager') && $costCenter->employeeNightTeamManager->count() > 0)
                    @foreach($costCenter->employeeNightTeamManager as $employeeNightTeamManager)
                    <option selected value="{{$employeeNightTeamManager->pivot->employee_id}}">{{$employeeNightTeamManager->first_name}} {{$employeeNightTeamManager->last_name}}</option>
                    @endforeach
                    @endif
                    <option value=""></option>
                    @foreach($supervisors as $supervisor)
                    <option {{old('night_team_manager') ? (old('night_team_manager') == $supervisor->id ? 'selected' : '') : ''}} value="{{$supervisor->id}}">{{$supervisor->first_name}} {{$supervisor->last_name}}</option>
                    @endforeach
                    </select>
                    @if($errors->has('night_team_manager'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('night_team_manager')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-cost-center-day-team-leader">Day Team Leader @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('day_team_leader') ? 'is-invalid' : ''}}" id="edit-cost-center-day-team-leader" name="day_team_leader">
                    @if(!old('day_team_leader') && $costCenter->employeeDayTeamLeader->count() > 0)
                    @foreach($costCenter->employeeDayTeamLeader as $employeeDayTeamLeader)
                    <option selected value="{{$employeeDayTeamLeader->pivot->employee_id}}">{{$employeeDayTeamLeader->first_name}} {{$employeeDayTeamLeader->last_name}}</option>
                    @endforeach
                    @endif
                    <option value=""></option>
                    @foreach($supervisors as $supervisor)
                    <option {{old('day_team_leader') ? (old('day_team_leader') == $supervisor->id ? 'selected' : '') : ''}} value="{{$supervisor->id}}">{{$supervisor->first_name}} {{$supervisor->last_name}}</option>
                    @endforeach
                    </select>
                    @if($errors->has('day_team_leader'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('day_team_leader')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-cost-center-night-team-leader">Night Team Leader @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('night_team_leader') ? 'is-invalid' : ''}}" id="edit-cost-center-night-team-leader" name="night_team_leader">
                    @if(!old('night_team_leader') && $costCenter->employeeNightTeamLeader->count() > 0)
                    @foreach($costCenter->employeeNightTeamLeader as $employeeNightTeamLeader)
                    <option selected value="{{$employeeNightTeamLeader->pivot->employee_id}}">{{$employeeNightTeamLeader->first_name}} {{$employeeNightTeamLeader->last_name}}</option>
                    @endforeach
                    @endif
                    <option value=""></option>
                    @foreach($supervisors as $supervisor)
                    <option {{old('night_team_leader') ? (old('night_team_leader') == $supervisor->id ? 'selected' : '') : ''}} value="{{$supervisor->id}}">{{$supervisor->first_name}} {{$supervisor->last_name}}</option>
                    @endforeach
                    </select>
                    @if($errors->has('night_team_leader'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('night_team_leader')}}
                        </span>
                    @endif
                </div>
                
            </div>

            <button type="submit" class="btn btn-success" id="edit-cost-center-submit-button">Save Cost Center</button>
        </form>
        @if(Auth::user()->hasAnyRole(['admin']))
        <form action="{{Route('costCenters.destroy', [$costCenter->id])}}" class="mt-2" id="delete-cost-center-form" method="POST">
            @csrf
            @method('Delete')
            <button type="submit" class="btn btn-outline-danger delete-item" id="delete-cost-center-submit-button" name="cost center">Delete Cost Center</button>
        </form>
        @endif

@endsection