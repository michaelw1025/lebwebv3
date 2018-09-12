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
                Query: Employee Anniversary By Quarter
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
                {{route('export-employee-anniversary-by-quarter', ['quarter' => $quarter, 'year' => $year])}}
                @endif
                @endslot

        @endcomponent
                

                @include('alerts.validation-alert')
                @include('alerts.session-alert')

                <!-- Page content goes here -->
        <form action="{{Route('queries.employee-anniversary-by-quarter')}}" class="mt-2" id="search-employee-anniversary-by-quarter-form" method="GET">
            @csrf
            <h5>Search Anniversaries</h5>
            <p class="text-danger">@component('components.required-icon')@endComponent indicates a required field</p>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="employee-anniversary-search-quarter">Calendar Quarter @component('components.required-icon')@endComponent</label>
                    <select name="anniversary_quarter" id="" class="custom-select {{$errors->has('anniversary_quarter') ? 'is-invalid' : ''}}" required>
                        <option value=""></option>
                        <option {{isset($quarter) ? ($quarter == 1 ? 'selected' : '') : ''}} value="1">Q1</option>
                        <option {{isset($quarter) ? ($quarter == 2 ? 'selected' : '') : ''}} value="2">Q2</option>
                        <option {{isset($quarter) ? ($quarter == 3 ? 'selected' : '') : ''}} value="3">Q3</option>
                        <option {{isset($quarter) ? ($quarter == 4 ? 'selected' : '') : ''}} value="4">Q4</option>
                    </select>
                    @if($errors->has('anniversary_quarter'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('anniversary_quarter')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="employee-anniversary-search-year">Year @component('components.required-icon')@endComponent</label>
                    <select name="anniversary_year" id="" class="custom-select {{$errors->has('anniversary_year') ? 'is-invalid' : ''}}" required>
                        <option value=""></option>
                        @for($i = 2015; $i < 2031; $i++)
                        <option {{isset($year) ? ($year == $i ? 'selected' : '') : ''}} value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                    @if($errors->has('anniversary_year'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('anniversary_year')}}
                        </span>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-success" id="submit-employee-anniversary-search">Search</button>
            <button type="button" class="btn btn-info reset-item-search" id="" name="search-employee-anniversary-form">Reset</button>
        </form>

        <hr></hr>

        @if(isset($employees))

        <table class="table table-sm table-hover">
            <thead class="bg-header text-light">
                <tr>
                    <th scope="col" class="d-none d-lg-table-cell">ID</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col" class="toggle-service-date">Service Date</th>
                    <th scope="col" class="d-none d-md-table-cell toggle-shift">Shift</th>
                    <th scope="col" class="toggle-cost-center">Cost Center</th>
                    <th scope="col" class="d-none d-xl-table-cell toggle-team-manager">Team Manager</th>
                    <th scope="col" class="toggle-team-leader">Team Leader</th>
                </tr>
            </thead>
            <tbody>
                @for($i = 5; $i < 55; $i += 5)
                <tr class="bg-info text-center"><td colspan="8">{{$i}}</td></tr>
                
                @foreach($employees as $employee)
                @if($employee->year_diff == $i)
                <tr class="clickable-row employee-row" data-href="{{route('employees.show', ['id' => $employee->id])}}">
                    <td class="d-none d-lg-table-cell">{{$employee->id}}</td>
                    <td>{{$employee->first_name}}</td>
                    <td>{{$employee->last_name}}</td>
                    <td class="toggle-service-date">{{$employee->service_date->format('m/d/Y')}}</td>
                    @if($employee->shift->count() > 0)
                        @foreach($employee->shift as $shift)
                        <td class="d-none d-md-table-cell toggle-shift">{{$shift->description}}</td>
                        @endforeach
                    @else
                        <td class="d-none d-md-table-cell toggle-shift text-danger">Not Set</td>
                    @endif
                    @if($employee->costCenter->count() > 0)
                        @foreach($employee->costCenter as $costCenter)
                        <td class="toggle-cost-center">{{$costCenter->number}} {{$costCenter->extension != null ? ' - '.$costCenter->extension : ''}}</td>
                        @endforeach
                    @else
                    <td class="toggle-cost-center text-danger">Not Set</td>
                    @endif
                    <td class="d-none d-xl-table-cell toggle-team-manager">{{$employee->team_manager}}</td>
                    <td class="toggle-team-leader">{{$employee->team_leader}}</td>
                </tr>
                @endif
                @endforeach
                @endfor
            </tbody>
        </table>

        @endif
            
@endsection