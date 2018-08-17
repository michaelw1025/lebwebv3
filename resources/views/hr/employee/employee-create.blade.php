@extends('layouts.app')

@section('content')

    @include('hr.sidebar')

    <article class="col-8 col-xs-9 col-sm-10 main-content-article">
        <h2 class="mt-2 text-create"><i class="fas fa-user-plus fa-lg"></i>&nbsp Create Employee</h2>
        <hr></hr>

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{Route('employees.store')}}" class="mt-2" id="create-employee-form" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <p class="text-danger">@component('components.required-icon')@endComponent indicates a required field</p>

            <!-- ****************************************
            Demographics
            **************************************** -->
            <div class="form-row">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-employee-first-name">First Name @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('first_name') ? 'is-invalid' : ''}}" id="create-employee-first-name" name="first_name" value="{{old('first_name')}}"  autofocus >
                    @if($errors->has('first_name'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('first_name')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-employee-last-name">Last Name @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('last_name') ? 'is-invalid' : ''}}" id="create-employee-last-name" name="last_name" value="{{old('last_name')}}" >
                    @if($errors->has('last_name'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('last_name')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-employee-middle-initial">MI</label>
                    <input type="text" class="form-control {{$errors->has('middle_initial') ? 'is-invalid' : ''}}" id="create-employee-middle-initial" name="middle_initial" value="{{old('middle_initial')}}">
                    @if($errors->has('middle_initial'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('middle_initial')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-employee-maiden-name">Maiden Name</label>
                    <input type="text" class="form-control {{$errors->has('maiden_name') ? 'is-invalid' : ''}}" id="create-employee-maiden-name" name="maiden_name" value="{{old('maiden_name')}}">
                    @if($errors->has('maiden_name'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('maiden_name')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-employee-nick-name">Nick Name</label>
                    <input type="text" class="form-control {{$errors->has('nick_name') ? 'is-invalid' : ''}}" id="create-employee-nick-name" name="nick_name" value="{{old('nick_name')}}">
                    @if($errors->has('nick_name'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('nick_name')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-employee-suffix">Sufix</label>
                    <select class="custom-select {{$errors->has('suffix') ? 'is-invalid' : ''}}" id="create-employee-suffix" name="suffix">
                        <option {{old('suffix') ? (old('suffix') == '' ? 'selected' : '') : ''}} value=""></option>
                        <option {{old('suffix') ? (old('suffix') == 'mr' ? 'selected' : '') : ''}} value="mr">Mr</option>
                        <option {{old('suffix') ? (old('suffix') == 'mrs' ? 'selected' : '') : ''}} value="mrs">Mrs</option>
                        <option {{old('suffix') ? (old('suffix') == 'miss' ? 'selected' : '') : ''}} value="miss">Miss</option>
                        <option {{old('suffix') ? (old('suffix') == 'jr' ? 'selected' : '') : ''}} value="jr">Jr</option>
                        <option {{old('suffix') ? (old('suffix') == 'sr' ? 'selected' : '') : ''}} value="sr">Sr</option>
                        <option {{old('suffix') ? (old('suffix') == 'ii' ? 'selected' : '') : ''}} value="ii">II</option>
                        <option {{old('suffix') ? (old('suffix') == 'iii' ? 'selected' : '') : ''}} value="iii">III</option>
                    </select>
                    @if($errors->has('suffix'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('suffix')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-employee-ssn">SSN @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('ssn') ? 'is-invalid' : ''}} ssn-format" id="create-employee-ssn" name="ssn" value="{{old('ssn')}}"  maxlength="11">
                    @if($errors->has('ssn'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('ssn')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-employee-gender">Gender @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('gender') ? 'is-invalid' : ''}}" id="create-employee-gender" name="gender">
                        <option {{old('gender') ? (old('gender') == '' ? 'selected' : '') : ''}} value=""></option>
                        <option {{old('gender') ? (old('gender') == 'male' ? 'selected' : '') : ''}} value="male">Male</option>
                        <option {{old('gender') ? (old('gender') == 'female' ? 'selected' : '') : ''}} value="female">Female</option>
                        <option {{old('gender') ? (old('gender') == 'other' ? 'selected' : '') : ''}} value="other">Other</option>
                        <option {{old('gender') ? (old('gender') == 'none' ? 'selected' : '') : ''}} value="none">None</option>
                    </select>
                    @if($errors->has('gender'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('gender')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-employee-oracle-number">Oracle Number</label>
                    <input type="text" class="form-control {{$errors->has('oracle_number') ? 'is-invalid' : ''}} is-number" id="create-employee-oracle-number" name="oracle_number" value="{{old('oracle_number')}}">
                    @if($errors->has('oracle_number'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('oracle_number')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-employee-birth-date">Birth Date @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('birth_date') ? 'is-invalid' : ''}} datepicker" id="create-employee-birth-date" name="birth_date" value="{{old('birth_date')}}" >
                    @if($errors->has('birth_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('birth_date')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-employee-hire-date">Hire Date @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('hire_date') ? 'is-invalid' : ''}} datepicker" id="create-employee-hire-date" name="hire_date" value="{{old('hire_date')}}" >
                    @if($errors->has('hire_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('hire_date')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-employee-service-date">Service Date @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('service_date') ? 'is-invalid' : ''}} datepicker" id="create-employee-service-date" name="service_date" value="{{old('service_date')}}" >
                    @if($errors->has('service_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('service_date')}}
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="create-employee-address-1">Address @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('address_1') ? 'is-invalid' : ''}}" id="create-employee-address-1" name="address_1" value="{{old('address_1')}}" >
                    @if($errors->has('address_1'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('address_1')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="create-employee-address-2">Address Cont.</label>
                    <input type="text" class="form-control {{$errors->has('address_2') ? 'is-invalid' : ''}}" id="create-employee-address-2" name="address_2" value="{{old('address_2')}}">
                    @if($errors->has('address_2'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('address_2')}}
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6 col-lg-4 col-lg-3">
                    <label for="create-employee-city">City @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('city') ? 'is-invalid' : ''}}" id="create-employee-city" name="city" value="{{old('city')}}" >
                    @if($errors->has('city'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('city')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4 col-lg-3">
                    <label for="create-employee-state">State @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('state') ? 'is-invalid' : ''}}" id="create-employee-state" name="state">
                        <option value="al">Alabama</option>
                        <option value="ak">Alaska</option>
                        <option value="az">Arizona</option>
                        <option value="ar">Arkansas</option>
                        <option value="ca">California</option>
                        <option value="co">Colorado</option>
                        <option value="ct">Connecticut</option>
                        <option value="de">Delaware</option>
                        <option value="dc">District Of Columbia</option>
                        <option value="fl">Florida</option>
                        <option value="ga">Georgia</option>
                        <option value="hi">Hawaii</option>
                        <option value="id">Idaho</option>
                        <option value="il">Illinois</option>
                        <option value="in">Indiana</option>
                        <option value="ia">Iowa</option>
                        <option value="ks">Kansas</option>
                        <option value="ky">Kentucky</option>
                        <option value="la">Louisiana</option>
                        <option value="me">Maine</option>
                        <option value="md">Maryland</option>
                        <option value="ma">Massachusetts</option>
                        <option value="mi">Michigan</option>
                        <option value="mn">Minnesota</option>
                        <option value="ms">Mississippi</option>
                        <option value="mo" selected>Missouri</option>
                        <option value="mt">Montana</option>
                        <option value="ne">Nebraska</option>
                        <option value="nv">Nevada</option>
                        <option value="nh">New Hampshire</option>
                        <option value="nj">New Jersey</option>
                        <option value="nm">New Mexico</option>
                        <option value="ny">New York</option>
                        <option value="nc">North Carolina</option>
                        <option value="nd">North Dakota</option>
                        <option value="oh">Ohio</option>
                        <option value="ok">Oklahoma</option>
                        <option value="or">Oregon</option>
                        <option value="pa">Pennsylvania</option>
                        <option value="ri">Rhode Island</option>
                        <option value="sc">South Carolina</option>
                        <option value="sd">South Dakota</option>
                        <option value="tn">Tennessee</option>
                        <option value="tx">Texas</option>
                        <option value="ut">Utah</option>
                        <option value="vt">Vermont</option>
                        <option value="va">Virginia</option>
                        <option value="wa">Washington</option>
                        <option value="wv">West Virginia</option>
                        <option value="wi">Wisconsin</option>
                        <option value="wy">Wyoming</option>
                    </select>
                    @if($errors->has('state'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('state')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4 col-lg-3">
                    <label for="create-employee-zip-code">Zip Code @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('zip_code') ? 'is-invalid' : ''}} is-number" id="create-employee-zip-code" name="zip_code" value="{{old('zip_code')}}" >
                    @if($errors->has('zip_code'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('zip_code')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4 col-lg-3">
                    <label for="create-employee-county">County @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('county') ? 'is-invalid' : ''}}" id="create-employee-county" name="county" value="{{old('county')}}" >
                    @if($errors->has('county'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('county')}}
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input {{$errors->has('photo_link') ? 'is-invalid' : ''}} picture-upload" id="create-employee-photo" name="photo_link">
                        <label for="create-employee-photo" class="custom-file-label">Choose Employee Photo</label>
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
                    <label for="create-employee-job">Job @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('job') ? 'is-invalid' : ''}}" id="create-employee-job" name="job">
                        <option value=""></option>
                        @foreach($jobs as $job)
                        <option {{old('job') ? (old('job') == $job->id ? 'selected' : '') : ''}} value="{{$job->id}}">{{$job->description}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('job'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('job')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-employee-position">Position @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('position') ? 'is-invalid' : ''}}" id="create-employee-position" name="position">
                        <option value=""></option>
                        @foreach($positions as $position)
                        <option {{old('position') ? (old('position') == $position->id ? 'selected' : '') : ''}} value="{{$position->id}}">{{$position->description}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('position'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('position')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-employee-cost-center">Cost Center @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('cost_center') ? 'is-invalid' : ''}}" id="create-employee-cost-center" name="cost_center">
                        <option value=""></option>
                        @foreach($costCenters as $costCenter)
                        <option {{old('cost_center') ? (old('cost_center') == $costCenter->id ? 'selected' : '') : ''}} value="{{$costCenter->id}}">{{$costCenter->number}}  {{$costCenter->extension}}  {{$costCenter->description}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('cost_center'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('cost_center')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-employee-shift">Shift @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('shift') ? 'is-invalid' : ''}}" id="create-employee-shift" name="shift">
                        <option value=""></option>
                        @foreach($shifts as $shift)
                        <option {{old('shift') ? (old('shift') == $shift->id ? 'selected' : '') : ''}} value="{{$shift->id}}">{{$shift->description}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('shift'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('shift')}}
                        </span>
                    @endif
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
                    <label for="create-employee-wage-title">Wage Title @component('components.required-icon')@endComponent</label>
                    <select name="wage_title" id="create-employee-wage-title" class="custom-select {{$errors->has('wage_title') ? 'is-invalid' : ''}} choose-wage-title">
                        <option value=""></option>
                        @foreach($wageTitles as $wageTitle)
                        <option {{old('wage_title') == $wageTitle->id ? 'selected' : ''}} value="{{$wageTitle->id}}">{{ucwords($wageTitle->description)}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('wage_title'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('wage_title')}}
                        </span>
                    @endif
                </div>
            </div>
            <table class="table table-sm table-borderless">
            <caption><button type="button" class="btn btn-outline-info clear-progression-events"> Clear Wage Events</button></caption>
                <thead class="bg-header text-light">
                    <tr>
                        <th><span class="d-none d-sm-block">Month</span><span class="d-sm-none">Mth</span></th>
                        <th><span class="d-none d-sm-block">Amount</span><span class="d-sm-none">Amt</span></th>
                        <th><span class="d-none d-sm-block">Increase Date</span><span class="d-sm-none">Date</span></th>
                    </tr>
                </thead>

                @if($errors->has('current_wage') || $errors->has('progression_event'))
                <thead>
                    <tr class="table-danger"><th colspan="3" class="text-danger">{{$errors->first('current_wage')}}</th></tr>
                    <tr class="table-danger"><th colspan="3" class="text-danger">{{$errors->first('progression_event')}}</th></tr>
                </thead>
                @endif
                
                <tbody>
                    @foreach($wageProgressions as $wageProgression)
                    <tr>
                        <td>{{$wageProgression->month}}</td>
                        @foreach($wageTitles as $wageTitle)
                        @foreach($wageTitle->wageProgression as $wageTitleProgression)
                        @if($wageTitleProgression->id === $wageProgression->id)
                        <td class="{{$wageTitle->description}} wage-progression-row d-none">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="create-employee-current-wage-{{$wageTitleProgression->pivot->id}}" name="current_wage" class="custom-control-input {{$errors->has('current_wage') ? 'is-invalid' : ''}}" value="{{$wageTitleProgression->pivot->id}}" {{old('current_wage') == $wageTitleProgression->pivot->id ? 'checked' : ''}} >
                                <label class="custom-control-label" for="create-employee-current-wage-{{$wageTitleProgression->pivot->id}}">{{$wageTitleProgression->pivot->amount}}</label>
                            </div>
                        </td>
                        @endif
                        @endforeach
                        @endforeach
                        <td>
                            <input type="text" class="form-control col-12 col-lg-6 datepicker progression-event {{$errors->has('progression_event.'.$loop->iteration.'.date') ? 'is-invalid' : ''}}" id="create-employee-progression-event-date-{{$loop->iteration}}" name="progression_event[{{$loop->iteration}}][date]" value="{{old('progression_event') ? old('progression_event.'.$loop->iteration.'.date') : ''}}" >
                            <input hidden type="text" class="form-control col-12 col-lg-6" id="create-employee-progression-event-id-{{$loop->iteration}}" name="progression_event[{{$loop->iteration}}][id]" value="{{$wageProgression->id}}">
                            @if($errors->has('progression_event.'.$loop->iteration.'.date'))
                                <span class="invalid-feedback" role="alert">
                                    {{$errors->first('progression_event.'.$loop->iteration.'.date')}}
                                </span>
                            @endif
                        </td>
                    </tr>
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
            @if(old('phone_number'))
                @php  
                $phoneNumberCount = count(old('phone_number')) + 1;
                @endphp
                @foreach(old('phone_number') as $oldPhoneNumber)
                <div class="col-lg-6 col-xxl-4 mb-3">
                    <label for="edit-employee-phone-number-{{$loop->iteration}}">Phone Number {{$loop->iteration}}</label>
                    <div class="input-group">
                        <div class="input-group-text">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input radio-select-primary" id="edit-employee-phone-number-{{$loop->iteration}}-primary" name="phone_number_is_primary" {{$oldPhoneNumber['number'] == old('phone_number_is_primary') ? 'checked' : ''}} value="{{$oldPhoneNumber['number']}}">
                                <label for="edit-employee-phone-number-{{$loop->iteration}}-primary" class="custom-control-label radio-select-primary-label ">Primary</label>
                            </div>
                        </div>
                        <input type="text" class="form-control phone-number-format {{$errors->has('phone_number.'.$loop->iteration.'.number') ? 'is-invalid' : ''}}" id="edit-employee-phone-number-{{$loop->iteration}}" name="phone_number[{{$loop->iteration}}][number]" value="{{$oldPhoneNumber['number']}}" maxlength="12">
                        <input hidden type="text" class="form-control" id="edit-employee-phone-number-id-{{$loop->iteration}}" name="phone_number[{{$loop->iteration}}][id]" value="{{$oldPhoneNumber['id']}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="edit-employee-phone-number-delete-{{$loop->iteration}}" name="phone_number[{{$loop->iteration}}][delete]" value="delete" {{in_array('delete', $oldPhoneNumber) ? 'checked' : ''}}>
                                    <label class="custom-control-label custom-control-label-delete" for="edit-employee-phone-number-delete-{{$loop->iteration}}">Delete</label>
                                </div>
                            </div>
                        </div>
                        @if($errors->has('phone_number.'.$loop->iteration.'.number'))
                            <span class="invalid-feedback" role="alert">
                                {{$errors->first('phone_number.'.$loop->iteration.'.number')}}
                            </span>
                        @endif
                    </div>
                </div>
                @endforeach
            @else
                @php
                $phoneNumberCount = 1;
                @endphp
            @endif

            @for($phoneNumberCount; $phoneNumberCount < 6; $phoneNumberCount++)
            <div class="col-lg-6 col-xxl-4 mb-3">
                    <label for="edit-employee-phone-number-{{$phoneNumberCount}}">Phone Number {{$phoneNumberCount}}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input radio-select-primary" id="edit-employee-phone-number-{{$phoneNumberCount}}-primary" name="phone_number_is_primary" value="">
                                    <label class="custom-control-label radio-select-primary-label " for="edit-employee-phone-number-{{$phoneNumberCount}}-primary">Primary</label>
                                </div>
                            </div>
                        </div>
                        <input type="text" class="form-control phone-number-format" id="edit-employee-phone-number-{{$phoneNumberCount}}" name="phone_number[{{$phoneNumberCount}}][number]" value="" maxlength="12">
                        <input hidden type="text" class="form-control" id="edit-employee-phone-number-id-{{$phoneNumberCount}}" name="phone_number[{{$phoneNumberCount}}][id]" value="">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="edit-employee-phone-number-delete-{{$phoneNumberCount}}" name="phone_number[{{$phoneNumberCount}}][delete]" value="delete">
                                    <label class="custom-control-label custom-control-label-delete" for="edit-employee-phone-number-delete-{{$phoneNumberCount}}">Delete</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
            </div>

            <!-- ****************************************
            Emergency Contacts
            **************************************** -->
            <header class="alert alert-primary mt-4 h2" role="alert">
                <i class="fas fa-star-of-life"></i> Emergency Contacts
            </header>
            <div class="form-row">
            @if(old('emergency_contact'))
                @php  
                $emergencyContactCount = count(old('emergency_contact')) + 1;
                @endphp
                @foreach(old('emergency_contact') as $oldEmergencyContact)
                <div class="col-xxl-6 mb-3">
                    <label for="edit-employee-emergency-contact-{{$loop->iteration}}">Emergency Contact {{$loop->iteration}} <span class="text-muted small">(number/name)</span></label>
                    <div class="input-group">
                        <div class="input-group-text">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input radio-select-primary" id="edit-employee-emergency-contact-{{$loop->iteration}}-primary" name="emergency_contact_is_primary" {{$oldEmergencyContact['number'] == old('emergency_contact_is_primary') ? 'checked' : ''}} value="{{$oldEmergencyContact['number']}}">
                                <label for="edit-employee-emergency-contact-{{$loop->iteration}}-primary" class="custom-control-label radio-select-primary-label ">Primary</label>
                            </div>
                        </div>
                        <input type="text" class="form-control phone-number-format {{$errors->has('emergency_contact.'.$loop->iteration.'.number') ? 'is-invalid' : ''}}" id="edit-employee-emergency-contact-{{$loop->iteration}}" name="emergency_contact[{{$loop->iteration}}][number]" value="{{$oldEmergencyContact['number']}}" maxlength="12">
                        <input type="text" class="form-control {{$errors->has('emergency_contact.'.$loop->iteration.'.name') ? 'is-invalid' : ''}}" id="edit-employee-emergency-contact-name-{{$loop->iteration}}" name="emergency_contact[{{$loop->iteration}}][name]" value="{{$oldEmergencyContact['name']}}">
                        <input hidden type="text" class="form-control" id="edit-employee-emergency-contact-id-{{$loop->iteration}}" name="emergency_contact[{{$loop->iteration}}][id]" value="{{$oldEmergencyContact['id']}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="edit-employee-emergency-contact-delete-{{$loop->iteration}}" name="emergency_contact[{{$loop->iteration}}][delete]" value="delete" {{in_array('delete', $oldEmergencyContact) ? 'checked' : ''}}>
                                    <label class="custom-control-label custom-control-label-delete" for="edit-employee-emergency-contact-delete-{{$loop->iteration}}">Delete</label>
                                </div>
                            </div>
                        </div>
                        @if($errors->has('emergency_contact.'.$loop->iteration.'.number'))
                            <span class="invalid-feedback" role="alert">
                                {{$errors->first('emergency_contact.'.$loop->iteration.'.number')}}
                            </span>
                        @endif
                        @if($errors->has('emergency_contact.'.$loop->iteration.'.name'))
                            <span class="invalid-feedback" role="alert">
                                {{$errors->first('emergency_contact.'.$loop->iteration.'.name')}}
                            </span>
                        @endif
                    </div>
                </div>
                @endforeach
            @else
                @php
                $emergencyContactCount = 1;
                @endphp
            @endif

            @for($emergencyContactCount; $emergencyContactCount < 6; $emergencyContactCount++)
            <div class="col-xxl-6 mb-3">
                    <label for="edit-employee-emergency-contact-{{$emergencyContactCount}}">Emergency Contact {{$emergencyContactCount}} <span class="text-muted small">(number/name)</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input radio-select-primary" id="edit-employee-emergency-contact-{{$emergencyContactCount}}-primary" name="emergency_contact_is_primary" value="">
                                    <label class="custom-control-label radio-select-primary-label " for="edit-employee-emergency-contact-{{$emergencyContactCount}}-primary">Primary</label>
                                </div>
                            </div>
                        </div>
                        <input type="text" class="form-control phone-number-format" id="edit-employee-emergency-contact-{{$emergencyContactCount}}" name="emergency_contact[{{$emergencyContactCount}}][number]" value="" maxlength="12">
                        <input type="text" class="form-control" id="edit-employee-emergency-contact-name-{{$emergencyContactCount}}" name="emergency_contact[{{$emergencyContactCount}}][name]" value="">
                        <input hidden type="text" class="form-control" id="edit-employee-emergency-contact-id-{{$emergencyContactCount}}" name="emergency_contact[{{$emergencyContactCount}}][id]" value="">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="edit-employee-emergency-contact-delete-{{$emergencyContactCount}}" name="emergency_contact[{{$emergencyContactCount}}][delete]" value="delete">
                                    <label class="custom-control-label custom-control-label-delete" for="edit-employee-emergency-contact-delete-{{$emergencyContactCount}}">Delete</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor 
            </div>


            <button type="submit" class="btn btn-success" id="create-employee-submit-button">Save Employee</button>
        </form>

        <hr class="my-4"></hr>
        <hr class="my-4"></hr>

    </article>

@endsection