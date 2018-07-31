@extends('layouts.app')

@section('content')

    @include('hr.sidebar')

    <article class="col-10 main-content-article">
        <h2 class="mt-2 text-primary"><i class="fas fa-user-tag fa-lg"></i>&nbsp Show Employee</h2>
        <hr></hr>

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="" class="mt-2" id="show-employee-form" method="GET">
            @csrf
            <a href="{{route('employees.edit', $employee->id)}}" class="btn btn-edit mb-1">Edit Employee</a>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="show-employee-first-name">First Name</label>
                    <input type="text" class="form-control" id="show-employee-first-name" name="first_name" value="{{$employee->first_name}}" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="show-employee-last-name">Last Name</label>
                    <input type="text" class="form-control" id="show-employee-last-name" name="last_name" value="{{$employee->last_name}}" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="show-employee-middle-initial">MI</label>
                    <input type="text" class="form-control" id="show-employee-middle-initial" name="middle_initial" value="{{$employee->middle_initial}}" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="show-employee-maiden-name">Maiden Name</label>
                    <input type="text" class="form-control" id="show-employee-maiden-name" name="maiden_name" value="{{$employee->maiden_name}}" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="show-employee-nick-name">Nick Name</label>
                    <input type="text" class="form-control" id="show-employee-nick-name" name="nick_name" value="{{$employee->nick_name}}" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="show-employee-suffix">Sufix</label>
                    <input type="text" class="form-control" id="show-employee-suffix" name="suffix" value="{{strtoupper($employee->suffix)}}" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="show-employee-ssn">SSN</label>
                    <input type="text" class="form-control" id="show-employee-ssn" name="ssn" value="{{$employee->ssn}}" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="show-employee-gender">Gender</label>
                    <input type="text" class="form-control" id="show-employee-gender" name="gender" value="{{$employee->gender}}" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="show-employee-oracle-number">Oracle Number</label>
                    <input type="text" class="form-control" id="show-employee-oracle-number" name="oracle_number" value="{{$employee->oracle_number}}" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="show-employee-birth-date">Birth Date</label>
                    <input type="text" class="form-control" id="show-employee-birth-date" name="birth_date" value="{{$employee->birth_date->format('m/d/Y')}}" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="show-employee-hire-date">Hire Date</label>
                    <input type="text" class="form-control" id="show-employee-hire-date" name="hire_date" value="{{$employee->hire_date->format('m/d/Y')}}" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="show-employee-service-date">Service Date</label>
                    <input type="text" class="form-control" id="show-employee-service-date" name="service_date" value="{{$employee->service_date->format('m/d/Y')}}" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="show-employee-address-1">Address</label>
                    <input type="text" class="form-control" id="show-employee-address-1" name="address_1" value="{{$employee->address_1}}" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="show-employee-address-2">Address Cont.</label>
                    <input type="text" class="form-control" id="show-employee-address-2" name="address_2" value="{{$employee->address_2}}" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6 col-lg-3">
                    <label for="show-employee-city">City</label>
                    <input type="text" class="form-control" id="show-employee-city" name="city" value="{{$employee->city}}" readonly>
                </div>
                <div class="form-group col-md-6 col-lg-3">
                    <label for="show-employee-state">State</label>
                    <input type="text" class="form-control" id="show-employee-state" name="state" value="{{$employee->stateFullName}}" readonly>
                </div>
                <div class="form-group col-md-6 col-lg-3">
                    <label for="show-employee-zip-code">Zip Code</label>
                    <input type="text" class="form-control" id="show-employee-zip-code" name="zip_code" value="{{$employee->zip_code}}" readonly>
                </div>
                <div class="form-group col-md-6 col-lg-3">
                    <label for="show-employee-county">County</label>
                    <input type="text" class="form-control" id="show-employee-county" name="county" value="{{$employee->county}}" readonly>
                </div>
            </div>
            <div class="form-row">

            </div>
            <a href="{{route('employees.edit', $employee->id)}}" class="btn btn-edit">Edit Employee</a>
        </form>

    </article>

@endsection