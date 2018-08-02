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
            @if($employee->photo_link !== null)
            <img src="/storage/{{$employee->photo_link}}" alt="Employee Photo" class="img-thumbnail mb-2" width="100" height="100">
            @else
            <img src="/storage/unknown.png" alt="Employee Photo" class="img-thumbnail mb-2" width="100" height="100">
            @endif

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="show-employee-first-name">First Name</label>
                    <input type="text" class="form-control" id="show-employee-first-name" name="first_name" value="{{$employee->first_name}}" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="show-employee-last-name">Last Name</label>
                    <input type="text" class="form-control" id="show-employee-last-name" name="last_name" value="{{$employee->last_name}}" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="show-employee-middle-initial">MI</label>
                    <input type="text" class="form-control" id="show-employee-middle-initial" name="middle_initial" value="{{$employee->middle_initial}}" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="show-employee-maiden-name">Maiden Name</label>
                    <input type="text" class="form-control" id="show-employee-maiden-name" name="maiden_name" value="{{$employee->maiden_name}}" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="show-employee-nick-name">Nick Name</label>
                    <input type="text" class="form-control" id="show-employee-nick-name" name="nick_name" value="{{$employee->nick_name}}" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="show-employee-suffix">Sufix</label>
                    <input type="text" class="form-control" id="show-employee-suffix" name="suffix" value="{{strtoupper(strtoupper($employee->suffix))}}" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="show-employee-ssn">SSN</label>
                    <input type="text" class="form-control" id="show-employee-ssn" name="ssn" value="{{$employee->ssn}}" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="show-employee-gender">Gender</label>
                    <input type="text" class="form-control" id="show-employee-gender" name="gender" value="{{ucwords($employee->gender)}}" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="show-employee-oracle-number">Oracle Number</label>
                    <input type="text" class="form-control" id="show-employee-oracle-number" name="oracle_number" value="{{$employee->oracle_number}}" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="show-employee-birth-date">Birth Date</label>
                    <input type="text" class="form-control" id="show-employee-birth-date" name="birth_date" value="{{$employee->birth_date->format('m/d/Y')}}" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="show-employee-hire-date">Hire Date</label>
                    <input type="text" class="form-control" id="show-employee-hire-date" name="hire_date" value="{{$employee->hire_date->format('m/d/Y')}}" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="show-employee-service-date">Service Date</label>
                    <input type="text" class="form-control" id="show-employee-service-date" name="service_date" value="{{$employee->service_date->format('m/d/Y')}}" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="show-employee-address-1">Address</label>
                    <input type="text" class="form-control" id="show-employee-address-1" name="address_1" value="{{$employee->address_1}}" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label for="show-employee-address-2">Address Cont.</label>
                    <input type="text" class="form-control" id="show-employee-address-2" name="address_2" value="{{$employee->address_2}}" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6 col-lg-3">
                    <label for="show-employee-city">City</label>
                    <input type="text" class="form-control" id="show-employee-city" name="city" value="{{$employee->city}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-3">
                    <label for="show-employee-state">State</label>
                    <input type="text" class="form-control" id="show-employee-state" name="state" value="{{$employee->state_full_name}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-3">
                    <label for="show-employee-zip-code">Zip Code</label>
                    <input type="text" class="form-control" id="show-employee-zip-code" name="zip_code" value="{{$employee->zip_code}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-3">
                    <label for="show-employee-county">County</label>
                    <input type="text" class="form-control" id="show-employee-county" name="county" value="{{$employee->county}}" disabled>
                </div>
            </div>

            <div class="form-row card-deck mb-3">
                <div class="card bg-light {{$employee->status === '1' ? 'border-success' : 'border-danger'}}">
                    <div class="card-header">Status</div>
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="show-employee-status-active" value="1" {{$employee->status == '1' ? 'checked' : ''}} disabled>
                            <label class="form-check-label" for="show-employee-status-active">
                            Active
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="show-employee-status-inactive" value="0" {{$employee->status == '0' ? 'checked' : ''}} disabled>
                            <label class="form-check-label" for="show-employee-status-inactive">
                            Inactive
                            </label>
                        </div>
                    </div>
                </div>

                <div class="card bg-light {{$employee->rehire === '1' ? 'border-success' : 'border-danger'}}">
                    <div class="card-header">Rehire</div>
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rehire" id="show-employee-rehire-yes" value="1" {{$employee->rehire == '1' ? 'checked' : ''}} disabled>
                            <label class="form-check-label" for="show-employee-rehire-yes">
                            Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rehire" id="show-employee-rehire-no" value="0" {{$employee->rehire == '0' ? 'checked' : ''}} disabled>
                            <label class="form-check-label" for="show-employee-rehire-no">
                            No
                            </label>
                        </div>
                    </div>
                </div>

                <div class="card bg-light">
                    <div class="card-header">Reviews</div>
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="thirty_day_review" id="show-employee-thirty-day-review" value="1" {{$employee->thirty_day_review == '1' ? 'checked' : ''}} disabled>
                            <label class="form-check-label" for="show-employee-thirty-day-review">
                            Thirty Day
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sixty_day_review" id="show-employee-sixty-day-review" value="1" {{$employee->sixty_day_review == '1' ? 'checked' : ''}} disabled>
                            <label class="form-check-label" for="show-employee-sixty-day-review">
                            Sixty Day
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <header class="alert alert-primary mt-4 h2" role="alert">
                <i class="fas fa-dolly"></i> Occupation
            </header>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="show-employee-cost-center">Cost Center</label>
                    <input type="text" class="form-control" id="show-employee-cost-center" name="cost_center" value="@foreach($employee->costCenter as $employeeCostCenter) {{$employeeCostCenter->number}}  {{$employeeCostCenter->extension}}  {{$employeeCostCenter->description}} @endforeach" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="show-employee-shift">Shift</label>
                    <input type="text" class="form-control" id="show-employee-shift" name="shift" value="@foreach($employee->shift as $employeeShift) {{$employeeShift->code}} - {{$employeeShift->description}} @endforeach" disabled>
                </div>
            </div>


            <a href="{{route('employees.edit', $employee->id)}}" class="btn btn-edit">Edit Employee</a>
        </form>

    </article>

@endsection