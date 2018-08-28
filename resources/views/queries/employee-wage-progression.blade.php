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
                Query: Employee Wage Progresion
                @endslot

                @slot('displayExport')
                d-block
                @endslot

                @slot('exportRoute')
                @if(isset($employees))
                {{route('export-employee-wage-progression', ['month' => $month, 'year' => $year])}}
                @endif
                @endslot
        @endcomponent
                

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <!-- Page content goes here -->
        <form action="{{Route('queries.employee-wage-progression')}}" class="mt-2" id="search-employee-wage-progression-form" method="GET">
            @csrf
            <h5>Search Wage Progressions</h5>
            <p class="text-danger">@component('components.required-icon')@endComponent indicates a required field</p>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="employee-wage-progression-search-month">Month @component('components.required-icon')@endComponent</label>
                    <select name="wage_progression_month" id="employee-wage-progression-search-month" class="custom-select {{$errors->has('wage_progression_month') ? 'is-invalid' : ''}}">
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
                    @if($errors->has('wage_progression_month'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('wage_progression_month')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="employee-wage-progression-search-year">Year @component('components.required-icon')@endComponent</label>
                    <select name="wage_progression_year" id="employee-wage-progression-search-year" class="custom-select {{$errors->has('wage_progression_year') ? 'is-invalid' : ''}}">
                        <option value=""></option>
                        @for($i = 2015; $i < 2031; $i++)
                        <option {{isset($year) ? ($year == $i ? 'selected' : '') : ''}} value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                    @if($errors->has('wage_progression_year'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('wage_progression_year')}}
                        </span>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-success" id="submit-employee-wage-progression-search">Search</button>
            <button type="button" class="btn btn-info reset-item-search" id="" name="search-employee-wage-progression-form">Reset</button>
        </form>

        <hr></hr>

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
                    <th scope="col" class="toggle-first-name">Name</th>
                    <th scope="col" class="toggle-ssn">SSN</th>
                    <th scope="col" class="toggle-oracle-number">Oracle Number</th>
                    <th scope="col" class="toggle-hire-date">Hire Date</th>
                    <th scope="col" class="toggle-progression-date">Progression Date</th>
                    <th scope="col" class="toggle-shift">Shift</th>
                    <th scope="col" class="toggle-cost-center">Cost Center</th>
                    <th scope="col" class="toggle-position">Position</th>
                    <th scope="col" class="d-none toggle-team-manager">Team Manager</th>
                    <th scope="col" class="d-none toggle-team-leader">Team Leader</th>
                </tr>
            </thead>
            <tbody>
                @foreach($wageProgressions as $wageProgression)
                @continue($wageProgression->month == 0)
                <tr class="bg-info text-center"><td colspan="15">{{$wageProgression->month}} Month Progression</td></tr>
                
                @foreach($employees as $employee)
                @foreach($employee->wageProgression as $employeeWageProgression)
                @if($employeeWageProgression->id === $wageProgression->id)
                
                <tr class="clickable-row employee-row" data-href="{{route('employees.show', ['id' => $employee->id])}}">
                    <td class="d-none d-lg-table-cell">{{$employee->id}}</td>
                    <td class="toggle-first-name">{{$employee->first_name}} {{$employee->middle_initial}} {{$employee->last_name}}</td>
                    <td class="toggle-ssn"><span class="d-inline-block">{{$employee->ssn}}</span></td>
                    <td class="toggle-oracle-number">{{$employee->oracle_number}}</td>
                    <td class="toggle-hire-date">{{$employee->hire_date->format('m/d/Y')}}</td>
                    <td class="toggle-progression-date">{{$employeeWageProgression->pivot->date->format('m/d/Y')}}</td>
                    @if($employee->shift->count() > 0)
                        @foreach($employee->shift as $shift)
                        <td class="toggle-shift">{{$shift->description}}</td>
                        @endforeach
                    @else
                        <td class="toggle-shift text-danger">Not Set</td>
                    @endif
                    @if($employee->costCenter->count() > 0)
                        @foreach($employee->costCenter as $costCenter)
                        <td class="toggle-cost-center">{{$costCenter->number}} {{$costCenter->extension != null ? ' - '.$costCenter->extension : ''}}</td>
                        @endforeach
                    @else
                    <td class="toggle-cost-center text-danger">Not Set</td>
                    @endif
                    @if($employee->position->count() > 0)
                        @foreach($employee->position as $position)
                        <td class="toggle-position">{{$position->description}}</td>
                        @endforeach
                    @else
                        <td class="toggle-position text-danger">Not Set</td>
                    @endif
                    <td class="d-none toggle-team-manager">{{$employee->team_manager}}</td>
                    <td class="d-none toggle-team-leader">{{$employee->team_leader}}</td>
                </tr>
                @endif
                @endforeach
                @endforeach

                @endforeach
            </tbody>
        </table>

@endif
            
@endsection