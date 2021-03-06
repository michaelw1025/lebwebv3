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
            {{$statusType === 1 ? 'fa-user-check' : 'fa-user-slash'}}
            @endslot

            @slot('fontSize')
            fa-lg
            @endslot

            @slot('title')
            Employees: {{$statusType === 1 ? 'Active' : 'Inactive'}}
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="" class="mt-2" id="search-employee-form">
            @csrf
            <h5>Search Employees</h5>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="employee-search-last-name">Last Name</label>
                    <input type="text" class="form-control" id="employee-search-last-name" name="employee_search_last_name" autofocus>
                </div>
                <div class="form-group col-md-6">
                    <label for="employee-search-ssn">SSN</label>
                    <input type="text" class="form-control ssn-format" id="employee-search-ssn" name="employee_search_ssn" maxlength="11">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="employee-search-birth-date">Birth Date <small class="text-muted">(mm/dd/yyyy)</small></label>
                    <input type="text" class="form-control datepicker" id="employee-search-birth-date" name="employee_search_birth_date">
                </div>
                <div class="form-group col-md-6">
                    <label for="employee-search-hire-date">Hire Date <small class="text-muted">(mm/dd/yyyy)</small></label>
                    <input type="text" class="form-control datepicker" id="employee-search-hire-date" name="employee_search_hire_date">
                </div>
            </div>
            <button type="submit" class="btn btn-success" id="submit-employee-search">Search</button>
            <p class="btn btn-info mt-3" id="reset-employee-search">Reset</p>
        </form>

        <hr></hr>

        <table class="table table-sm table-hover table-striped table-borderless">
            <thead class="bg-header text-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">MI</th>
                    <th scope="col">SFX</th>
                    <th scope="col" class="d-none d-md-table-cell">SSN</th>
                    <th scope="col" class="d-none d-md-table-cell">Birth Date</th>
                    <th scope="col" class="d-none d-md-table-cell">Hire Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                <tr class="clickable-row employee-row" data-href="{{route('employees.show', ['id' => $employee->id])}}">
                    <td>{{$employee->id}}</td>
                    <td>{{$employee->first_name}}</td>
                    <td class="employee-name">{{$employee->last_name}}</td>
                    <td>{{$employee->middle_initial}}</td>
                    <td>{{strtoupper($employee->suffix)}}</td>
                    <td class="d-none d-md-table-cell employee-ssn">{{$employee->ssn}}</td>
                    <td class="d-none d-md-table-cell employee-birth-date">{{$employee->birth_date->format('m/d/Y')}}</td>
                    <td class="d-none d-md-table-cell employee-hire-date">{{$employee->hire_date->format('m/d/Y')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

@endsection