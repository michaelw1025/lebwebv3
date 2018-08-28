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
            fa-user-tag
            @endslot

            @slot('fontSize')
            fa-lg
            @endslot

            @slot('title')
            Show {{$employee->first_name}} {{$employee->last_name}}
            @endslot

            @slot('displayExport')
            d-block
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="" class="mt-2" id="show-employee-form" method="GET" autocomplete="off">
            @csrf
            @if($employee->photo_link !== null)
            <img src="/storage/{{$employee->photo_link}}" alt="Employee Photo" class="img-thumbnail mb-2" width="100" height="100">
            @else
            <img src="/storage/unknown.png" alt="Employee Photo" class="img-thumbnail mb-2" width="100" height="100">
            @endif

            <!-- ****************************************
            Demographics
            **************************************** -->
            <div class="form-row">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-employee-id">Employee ID</label>
                    <input type="text" class="form-control" id="show-employee-id" name="id" value="{{$employee->id}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-employee-first-name">First Name</label>
                    <input type="text" class="form-control" id="show-employee-first-name" name="first_name" value="{{$employee->first_name}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-employee-last-name">Last Name</label>
                    <input type="text" class="form-control" id="show-employee-last-name" name="last_name" value="{{$employee->last_name}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-employee-middle-initial">MI</label>
                    <input type="text" class="form-control" id="show-employee-middle-initial" name="middle_initial" value="{{$employee->middle_initial}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-employee-maiden-name">Maiden Name</label>
                    <input type="text" class="form-control" id="show-employee-maiden-name" name="maiden_name" value="{{$employee->maiden_name}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-employee-nick-name">Nick Name</label>
                    <input type="text" class="form-control" id="show-employee-nick-name" name="nick_name" value="{{$employee->nick_name}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-employee-suffix">Sufix</label>
                    <input type="text" class="form-control" id="show-employee-suffix" name="suffix" value="{{strtoupper(strtoupper($employee->suffix))}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-employee-ssn">SSN</label>
                    <input type="text" class="form-control" id="show-employee-ssn" name="ssn" value="{{$employee->ssn}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-employee-gender">Gender</label>
                    <input type="text" class="form-control" id="show-employee-gender" name="gender" value="{{ucwords($employee->gender)}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-employee-oracle-number">Oracle Number</label>
                    <input type="text" class="form-control" id="show-employee-oracle-number" name="oracle_number" value="{{$employee->oracle_number}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-employee-birth-date">Birth Date</label>
                    <input type="text" class="form-control" id="show-employee-birth-date" name="birth_date" value="{{$employee->birth_date->format('m/d/Y')}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-employee-hire-date">Hire Date</label>
                    <input type="text" class="form-control" id="show-employee-hire-date" name="hire_date" value="{{$employee->hire_date->format('m/d/Y')}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
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
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-employee-city">City</label>
                    <input type="text" class="form-control" id="show-employee-city" name="city" value="{{$employee->city}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-employee-state">State</label>
                    <input type="text" class="form-control" id="show-employee-state" name="state" value="{{$employee->state_full_name}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-employee-zip-code">Zip Code</label>
                    <input type="text" class="form-control" id="show-employee-zip-code" name="zip_code" value="{{$employee->zip_code}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-employee-county">County</label>
                    <input type="text" class="form-control" id="show-employee-county" name="county" value="{{$employee->county}}" disabled>
                </div>
            </div>
            <div class="form-row card-deck mb-3">
                <div class="card bg-light {{$employee->status === '1' ? 'border-success' : 'border-danger'}}">
                    <div class="card-header">Status</div>
                    <div class="card-body">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" name="status" id="show-employee-status-active" value="1" {{$employee->status == '1' ? 'checked' : ''}} disabled>
                            <label class="custom-control-label" for="show-employee-status-active">
                            Active
                            </label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" name="status" id="show-employee-status-inactive" value="0" {{$employee->status == '0' ? 'checked' : ''}} disabled>
                            <label class="custom-control-label" for="show-employee-status-inactive">
                            Inactive
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card bg-light {{$employee->rehire === '1' ? 'border-success' : 'border-danger'}}">
                    <div class="card-header">Rehire</div>
                    <div class="card-body">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" name="rehire" id="show-employee-rehire-yes" value="1" {{$employee->rehire == '1' ? 'checked' : ''}} disabled>
                            <label class="custom-control-label" for="show-employee-rehire-yes">
                            Yes
                            </label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" name="rehire" id="show-employee-rehire-no" value="0" {{$employee->rehire == '0' ? 'checked' : ''}} disabled>
                            <label class="custom-control-label" for="show-employee-rehire-no">
                            No
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card bg-light">
                    <div class="card-header">Reviews</div>
                    <div class="card-body">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="thirty_day_review" id="show-employee-thirty-day-review" value="1" {{$employee->thirty_day_review == '1' ? 'checked' : ''}} disabled>
                            <label class="custom-control-label" for="show-employee-thirty-day-review">
                            Thirty Day
                            </label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="sixty_day_review" id="show-employee-sixty-day-review" value="1" {{$employee->sixty_day_review == '1' ? 'checked' : ''}} disabled>
                            <label class="custom-control-label" for="show-employee-sixty-day-review">
                            Sixty Day
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ****************************************
            Occupation
            **************************************** -->
            <header class="alert alert-primary mt-4 h2" role="alert">
                <i class="fas fa-dolly"></i> Occupation
            </header>
            <div class="form-row">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-employee-job">Job</label>
                    <input type="text" class="form-control" id="show-employee-job" name="job" value="@foreach($employee->job as $employeeJob) {{$employeeJob->description}} @endforeach" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-employee-position">Position</label>
                    <input type="text" class="form-control" id="show-employee-position" name="position" value="@foreach($employee->position as $employeePosition) {{$employeePosition->description}} @endforeach" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-employee-cost-center">Cost Center</label>
                    <input type="text" class="form-control" id="show-employee-cost-center" name="cost_center" value="@foreach($employee->costCenter as $employeeCostCenter) {{$employeeCostCenter->number}}  {{$employeeCostCenter->extension}}  {{$employeeCostCenter->description}} @endforeach" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-employee-shift">Shift</label>
                    <input type="text" class="form-control" id="show-employee-shift" name="shift" value="@foreach($employee->shift as $employeeShift) {{$employeeShift->description}} @endforeach" disabled>
                </div>
            </div>

            <!-- ****************************************
            Wage
            **************************************** -->
            <header class="alert alert-primary mt-4 h2" role="alert">
                <i class="fas fa-money-bill-wave"></i> Wage
            </header>
            <div class="form-row">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-employee-wage-title">Wage Title</label>
                    <input type="text" class="form-control" id="show-employee-wage-title" name="wage_title" value="@foreach($employee->position as $employeePosition) @foreach($employeePosition->wageTitle as $employeeWageTitle) {{ucwords($employeeWageTitle->description)}} @endforeach @endforeach" disabled>
                </div>
            </div>
            <table class="table table-sm table-borderless">
                <thead class="bg-header text-light">
                    <tr>
                        <th><span class="d-none d-sm-block">Month</span><span class="d-sm-none">Mth</span></th>
                        <th><span class="d-none d-sm-block">Amount</span><span class="d-sm-none">Amt</span></th>
                        <th><span class="d-none d-sm-block">Increase Date</span><span class="d-sm-none">Date</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employee->position as $employeePosition)
                    @foreach($employeePosition->wageTitle as $employeePositionWageTitle)
                    @foreach($employeePositionWageTitle->wageProgression as $employeePositionWageProgression)
                    <tr class="@foreach($employee->wageProgressionWageTitle as $employeeCurrentWage) {{$employeeCurrentWage->id === $employeePositionWageProgression->pivot->id ? 'table-info' : ''}} @endforeach" data-href="">
                        <td>{{$employeePositionWageProgression->month}}</td>
                        <td>{{$employeePositionWageProgression->pivot->amount}}</td>
                        <td>
                        @foreach($employee->wageProgression as $employeeWageProgression)
                        @if($employeeWageProgression->pivot->wage_progression_id === $employeePositionWageProgression->pivot->wage_progression_id)
                            {{$employeeWageProgression->pivot->date->format('m/d/Y')}}
                        @endif
                        @endforeach
                        </td>
                    </tr>
                    @endforeach
                    @endforeach
                    @endforeach
                </tbody>
            </table>

            <!-- ****************************************
            Phone Number
            **************************************** -->
            <header class="alert alert-primary mt-4 h2" role="alert">
                <i class="fas fa-phone"></i> Phone Numbers
            </header>
            <div class="form-row">
                @foreach($employee->phoneNumber as $employeePhoneNumber)
                <div class="col-md-6 col-xxl-4 mb-3">
                    <label for="show-employee-phone-number-{{$loop->iteration}}">Phone Number {{$loop->iteration}}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="show-employee-phone-number-primary-{{$loop->iteration}}" name="phone_number_is_primary_{{$loop->iteration}}" {{$employeePhoneNumber->is_primary == '1' ? 'checked' : ''}} disabled>
                                    <label class="custom-control-label" for="show-employee-phone-number-primary-{{$loop->iteration}}">Primary</label>
                                </div>
                            </div>
                        </div>
                        <input type="text" class="form-control" id="show-employee-phone-number-{{$loop->iteration}}" name="phone_number_{{$loop->iteration}}" value="{{$employeePhoneNumber->number}}" disabled>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- ****************************************
            Emergency Contacts
            **************************************** -->
            <header class="alert alert-primary mt-4 h2" role="alert">
                <i class="fas fa-star-of-life"></i> Emergency Contacts
            </header>
            <div class="form-row">
                @foreach($employee->emergencyContact as $employeeEmergencyContact)
                <div class="col-xxl-6 mb-3">
                    <label for="show-employee-emergency-contact-{{$loop->iteration}}">Emergency Contact {{$loop->iteration}} <span class="text-muted small">(number/name)</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="show-employee-emergency-contact-primary-{{$loop->iteration}}" name="emergency_contact_is_primary_{{$loop->iteration}}" {{$employeeEmergencyContact->is_primary == '1' ? 'checked' : ''}} disabled>
                                    <label class="custom-control-label" for="show-employee-emergency-contact-primary-{{$loop->iteration}}">Primary</label>
                                </div>
                            </div>
                        </div>
                        <input type="text" class="form-control" id="show-employee-emergency-contact-{{$loop->iteration}}" name="emergency_contact_{{$loop->iteration}}" value="{{$employeeEmergencyContact->number}}" disabled>
                        <input type="text" class="form-control" id="show-employee-emergency-contact-name-{{$loop->iteration}}" name="emergency_contact_name_{{$loop->iteration}}" value="{{$employeeEmergencyContact->name}}" disabled>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- ****************************************
            Disciplinary
            **************************************** -->
            <header class="alert alert-primary mt-4 h2" role="alert">
                <i class="fas fa-balance-scale"></i> Disciplinary
            </header>
            <table class="table table-sm table-hover table-borderless">
                <thead class="bg-header text-light">
                    <tr>
                        <th scope="col">Type</th>
                        <th scope="col">Level</th>
                        <th scope="col">Date</th>
                        <th scope="col" class="d-none d-md-table-cell">Cost Center</th>
                        <th scope="col" class="d-none d-md-table-cell">Issued By</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employee->disciplinary as $employeeDisciplinary)
                    <tr class="clickable-row {{$employeeDisciplinary->type == 'attendance' ? 'table-warning' : 'table-danger'}}" data-href="{{route('disciplinaries.show', ['id' => $employeeDisciplinary->id])}}">
                        <td>{{ucwords($employeeDisciplinary->type)}}</td>
                        <td>{{ucwords($employeeDisciplinary->level)}}</td>
                        <td class="employee-name">{{$employeeDisciplinary->date->format('m/d/Y')}}</td>
                        <td class="d-none d-md-table-cell">{{$employeeDisciplinary->cost_center_number}}</td>
                        <td class="d-none d-md-table-cell">{{$employeeDisciplinary->issuer_name}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- ****************************************
            Termination
            **************************************** -->
            <header class="alert alert-primary mt-4 h2" role="alert">
                <i class="fas fa-ban"></i> Termination
            </header>
            <table class="table table-sm table-hover table-borderless">
                <thead class="bg-header text-light">
                    <tr>
                        <th scope="col">Type</th>
                        <th scope="col">Date</th>
                        <th scope="col">Last Day</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employee->termination as $employeeTermination)
                    <tr class="clickable-row {{$employeeTermination->type == 'voluntary' ? 'table-warning' : 'table-danger'}}" data-href="{{route('terminations.show', ['id' => $employeeTermination->id])}}">
                        <td>{{ucwords($employeeTermination->type)}}</td>
                        <td>{{$employeeTermination->date->format('m/d/Y')}}</td>
                        <td>{{$employeeTermination->last_day->format('m/d/Y')}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- ****************************************
            Reduction
            **************************************** -->
            <header class="alert alert-primary mt-4 h2" role="alert">
                <i class="fas fa-angle-double-down"></i> Reduction
            </header>
            <table class="table table-sm table-hover table-borderless">
                <thead class="bg-header text-light">
                    <tr>
                        <th scope="col">Active</th>
                        <th scope="col">Type</th>
                        <th scope="col">Discplacement</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employee->reduction as $employeeReduction)
                    <tr class="clickable-row {{$employeeReduction->currently_active == '1' ? 'table-success' : 'table-secondary'}}" data-href="{{route('reductions.show', ['id' => $employeeReduction->id])}}">
                        <td><i class="far {{$employeeReduction->currently_active == '1' ? 'fa-check-circle' : 'fa-circle'}}"></i>{{$employeeReduction->currently_active == '1' ?'' : ''}}</td>
                        <td>{{ucwords($employeeReduction->type)}}</td>
                        <td>{{ucwords($employeeReduction->displacement)}}</td>
                        <td>{{$employeeReduction->date->format('m/d/Y')}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{route('employees.edit', $employee->id)}}" class="btn btn-edit mt-4">Edit Employee</a>
        </form>

        <hr class="my-4"></hr>
        <hr class="my-4"></hr>

@endsection