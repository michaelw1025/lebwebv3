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
                Query: Employee Birthday
                @endslot

                @slot('displayExport')
                @if(isset($employees))
                d-block
                @else
                d-none
                @endif
                @endslot

                @slot('exportRoute')
                @if(isset($employees))
                {{route('export-employee-birthday', ['month' => $month])}}
                @endif
                @endslot

        @endcomponent
                

        @include('alerts.validation-alert')
         @include('alerts.session-alert')

                <!-- Page content goes here -->
        <form action="{{Route('hr.queries.employee-birthday')}}" class="mt-2" id="search-employee-birthday-form" method="GET">
            @csrf
            <h5>Search Birthdays</h5>
            <p class="text-danger">@component('components.required-icon')@endComponent indicates a required field</p>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="employee-birthday-search-month">Month @component('components.required-icon')@endComponent</label>
                    <select name="birthday_month" id="employee-birthday-search-month" class="custom-select {{$errors->has('birthday_month') ? 'is-invalid' : ''}}">
                        <option value=""></option>
                        <option {{isset($month) ? ($month == 1 ? 'selected' : '') : ''}} value="1">1 - January</option>
                        <option {{isset($month) ? ($month == 2 ? 'selected' : '') : ''}} value="2">2 - February</option>
                        <option {{isset($month) ? ($month == 3 ? 'selected' : '') : ''}} value="3">3 - March</option>
                        <option {{isset($month) ? ($month == 4 ? 'selected' : '') : ''}} value="4">4 - April</option>
                        <option {{isset($month) ? ($month == 5 ? 'selected' : '') : ''}} value="5">5 - May</option>
                        <option {{isset($month) ? ($month == 6 ? 'selected' : '') : ''}} value="6">6 - June</option>
                        <option {{isset($month) ? ($month == 7 ? 'selected' : '') : ''}} value="7">7 - July</option>
                        <option {{isset($month) ? ($month == 8 ? 'selected' : '') : ''}} value="8">8 - August</option>
                        <option {{isset($month) ? ($month == 9 ? 'selected' : '') : ''}} value="9">9 - September</option>
                        <option {{isset($month) ? ($month == 10 ? 'selected' : '') : ''}} value="10">10 - October</option>
                        <option {{isset($month) ? ($month == 11 ? 'selected' : '') : ''}} value="11">11 - November</option>
                        <option {{isset($month) ? ($month == 12 ? 'selected' : '') : ''}} value="12">12 - December</option>
                    </select>
                    @if($errors->has('birthday_month'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('birthday_month')}}
                        </span>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-success" id="submit-employee-birthday-search">Search</button>
            <button type="button" class="btn btn-info reset-item-search" id="" name="search-employee-birthday-form">Reset</button>
        </form>

        <hr></hr>

         <!-- Hire date button -->
         @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-hire-date
                @endslot

                @slot('buttonText')
                Hire Date
                @endslot
        @endcomponent
        <!-- Shift button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-shift
                @endslot

                @slot('buttonText')
                Shift
                @endslot
        @endcomponent
        <!-- Job button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-job
                @endslot

                @slot('buttonText')
                Job
                @endslot
        @endcomponent
        <!-- Position button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-position
                @endslot

                @slot('buttonText')
                Position
                @endslot
        @endcomponent
        <!-- Cost center button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-cost-center
                @endslot

                @slot('buttonText')
                Cost Center
                @endslot
        @endcomponent
        <!-- Team manager button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-team-manager
                @endslot

                @slot('buttonText')
                Team Manager
                @endslot
        @endcomponent
        <!-- Team leader button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-team-leader
                @endslot

                @slot('buttonText')
                Team Leader
                @endslot
        @endcomponent

        @if(isset($employees))

        <table class="table table-sm table-hover">
            <thead class="bg-header text-light">
                <tr>
                    <th scope="col" class="d-none d-lg-table-cell">ID</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col" class="toggle-birth-date">Birth Date</th>
                    <th scope="col" class="d-none toggle-hire-date">Hire Date</th>
                    <th scope="col" class="d-none toggle-shift">Shift</th>
                    <th scope="col" class="d-none toggle-job">Job</th>
                    <th scope="col" class="d-none toggle-position">Position</th>
                    <th scope="col" class="d-none toggle-cost-center">Cost Center</th>
                    <th scope="col" class="d-none toggle-team-manager">Team Manager</th>
                    <th scope="col" class="d-none toggle-team-leader">Team Leader</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                <tr class="clickable-row employee-row" data-href="{{route('employees.show', ['id' => $employee->id])}}">
                    <td class="d-none d-lg-table-cell">{{$employee->id}}</td>
                    <td>{{$employee->first_name}}</td>
                    <td>{{$employee->last_name}}</td>
                    <td class="toggle-birth-date">{{$employee->birth_date->format('m/d/Y')}}</td>
                    <td class="d-none toggle-hire-date">{{$employee->hire_date->format('m/d/Y')}}</td>
                    @if($employee->shift->count() > 0)
                        @foreach($employee->shift as $shift)
                        <td class="d-none toggle-shift">{{$shift->description}}</td>
                        @endforeach
                    @else
                        <td class="d-none toggle-shift text-danger">Not Set</td>
                    @endif
                    @if($employee->job->count() > 0)
                        @foreach($employee->job as $job)
                        <td class="d-none toggle-job">{{$job->description}}</td>
                        @endforeach
                    @else
                        <td class="d-none toggle-job text-danger">Not Set</td>
                    @endif
                    @if($employee->position->count() > 0)
                        @foreach($employee->position as $position)
                        <td class="d-none toggle-position">{{$position->description}}</td>
                        @endforeach
                    @else
                        <td class="d-none toggle-position text-danger">Not Set</td>
                    @endif
                    @if($employee->costCenter->count() > 0)
                        @foreach($employee->costCenter as $costCenter)
                        <td class="d-none toggle-cost-center">{{$costCenter->number}} {{$costCenter->extension != null ? ' - '.$costCenter->extension : ''}}</td>
                        @endforeach
                    @else
                    <td class="d-none toggle-cost-center text-danger">Not Set</td>
                    @endif
                    <td class="d-none toggle-team-manager">{{$employee->team_manager}}</td>
                    <td class="d-none toggle-team-leader">{{$employee->team_leader}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @endif
            
@endsection