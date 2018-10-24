@extends('layouts.app')

@section('content')

        <!-- Title for content -->
        @component('components.content-title')
            @slot('textClass')
            text-edit
            @endslot

            @slot('fontStyle')
            fas
            @endslot

            @slot('fontIcon')
            fa-user-edit
            @endslot

            @slot('fontSize')
            fa-lg
            @endslot

            @slot('title')
            Edit {{$employee->first_name}} {{$employee->last_name}}
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')


        <form action="{{Route('employees.update', $employee->id)}}" class="" id="edit-employee-form" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('Patch')
            <div class="form-row">
                <a href="{{route('employees.show', ['id' => $employee->id])}}" class="h3 text-primary mb-4"><i class="fas fa-arrow-left"></i> Return To Show {{$employee->first_name}} {{$employee->last_name}}</a>
            </div>
            
            <div class="clearfix">
                @if($employee->photo_link !== null)
                <img src="/storage/{{$employee->photo_link}}" alt="Employee Photo" class="img-thumbnail mb-2 float-md-left" width="100" height="100">
                @else
                <img src="/storage/unknown.png" alt="Employee Photo" class="img-thumbnail mb-2 float-md-left" width="100" height="100">
                @endif

                <div class="float-md-right bg-info p-2 mb-2">
                    <h3>Team Manager: {{$employee->team_manager}}</h3>
                    <h3>Team Leader: {{$employee->team_leader}}</h3>
                </div>
            </div>

            <p class="text-danger">@component('components.required-icon')@endComponent indicates a required field</p>

            <!-- ****************************************
            Demographics
            **************************************** -->
            <div class="form-row">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-employee-id">Employee ID</label>
                    <input type="text" class="form-control" id="show-employee-id" name="id" value="{{$employee->id}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-employee-first-name">First Name @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('first_name') ? 'is-invalid' : ''}}" id="edit-employee-first-name" name="first_name" value="{{old('first_name') ? old('first_name') : $employee->first_name}}" required>
                    @if($errors->has('first_name'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('first_name')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-employee-last-name">Last Name @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('last_name') ? 'is-invalid' : ''}}" id="edit-employee-last-name" name="last_name" value="{{old('last_name') ? old('last_name') : $employee->last_name}}" required>
                    @if($errors->has('last_name'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('last_name')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-employee-middle-initial">MI</label>
                    <input type="text" class="form-control {{$errors->has('middle_initial') ? 'is-invalid' : ''}}" id="edit-employee-middle-initial" name="middle_initial" value="{{old('middle_initial') ? old('middle_initial') : $employee->middle_initial}}">
                    @if($errors->has('middle_initial'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('middle_initial')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-employee-maiden-name">Previous Name</label>
                    <input type="text" class="form-control {{$errors->has('maiden_name') ? 'is-invalid' : ''}}" id="edit-employee-maiden-name" name="maiden_name" value="{{old('maiden_name') ? old('maiden_name') : $employee->maiden_name}}">
                    @if($errors->has('maiden_name'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('maiden_name')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-employee-nick-name">Nick Name</label>
                    <input type="text" class="form-control {{$errors->has('nick_name') ? 'is-invalid' : ''}}" id="edit-employee-nick-name" name="nick_name" value="{{old('nick_name') ? old('nick_name') : $employee->nick_name}}">
                    @if($errors->has('nick_name'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('nick_name')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-employee-suffix">Sufix</label>
                    <select class="custom-select {{$errors->has('suffix') ? 'is-invalid' : ''}}" id="edit-employee-suffix" name="suffix">
                        @if(!old('suffix'))
                        <option value="{{$employee->suffix}}" selected>{{strtoupper($employee->suffix)}}</option>
                        @endif
                        <option {{old('suffix') ? (old('suffix') === '' ? 'selected' : '') : ''}} value=""></option>
                        <option {{old('suffix') ? (old('suffix') === 'jr' ? 'selected' : '') : ''}} value="jr">JR</option>
                        <option {{old('suffix') ? (old('suffix') === 'sr' ? 'selected' : '') : ''}} value="sr">SR</option>
                        <option {{old('suffix') ? (old('suffix') === 'ii' ? 'selected' : '') : ''}} value="ii">II</option>
                        <option {{old('suffix') ? (old('suffix') === 'iii' ? 'selected' : '') : ''}} value="iii">III</option>
                    </select>
                    @if($errors->has('suffix'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('suffix')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-employee-ssn">SSN @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('ssn') ? 'is-invalid' : ''}} ssn-format" id="edit-employee-ssn" name="ssn" value="{{old('ssn') ? old('ssn') : $employee->ssn}}"  maxlength="11" required>
                    @if($errors->has('ssn'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('ssn')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-employee-gender">Gender @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('gender') ? 'is-invalid' : ''}}" id="edit-employee-gender" name="gender" required>
                        @if(!old('gender'))
                        <option value="{{$employee->gender}}" selected>{{ucwords($employee->gender)}}</option>
                        @endif
                        <option {{old('gender') ? (old('gender') === '' ? 'selected' : '') : ''}} value=""></option>
                        <option {{old('gender') ? (old('gender') === 'male' ? 'selected' : '') : ''}} value="male">Male</option>
                        <option {{old('gender') ? (old('gender') === 'female' ? 'selected' : '') : ''}} value="female">Female</option>
                        <option {{old('gender') ? (old('gender') === 'other' ? 'selected' : '') : ''}} value="other">Other</option>
                        <option {{old('gender') ? (old('gender') === 'none' ? 'selected' : '') : ''}} value="none">None</option>
                    </select>
                    @if($errors->has('gender'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('gender')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-employee-oracle-number">Oracle Number</label>
                    <input type="text" class="form-control {{$errors->has('oracle_number') ? 'is-invalid' : ''}} is-number" id="edit-employee-oracle-number" name="oracle_number" value="{{old('oracle_number') ? old('oracle_number') : $employee->oracle_number}}">
                    @if($errors->has('oracle_number'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('oracle_number')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-employee-birth-date">Birth Date @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('birth_date') ? 'is-invalid' : ''}} datepicker" id="edit-employee-birth-date" name="birth_date" value="{{old('birth_date') ? old('birth_date') : $employee->birth_date->format('m/d/Y')}}" required>
                    @if($errors->has('birth_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('birth_date')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-employee-hire-date">Hire Date @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('hire_date') ? 'is-invalid' : ''}} datepicker" id="edit-employee-hire-date" name="hire_date" value="{{old('hire_date') ? old('hire_date') : $employee->hire_date->format('m/d/Y')}}" required>
                    @if($errors->has('hire_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('hire_date')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-employee-service-date">Service Date @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('service_date') ? 'is-invalid' : ''}} datepicker" id="edit-employee-service-date" name="service_date" value="{{old('service_date') ? old('service_date') : $employee->service_date->format('m/d/Y')}}" required>
                    @if($errors->has('service_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('service_date')}}
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="edit-employee-address-1">Address @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('address_1') ? 'is-invalid' : ''}}" id="edit-employee-address-1" name="address_1" value="{{old('address_1') ? old('address_1') : $employee->address_1}}" required>
                    @if($errors->has('address_1'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('address_1')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="edit-employee-address-2">Address Cont.</label>
                    <input type="text" class="form-control {{$errors->has('address_2') ? 'is-invalid' : ''}}" id="edit-employee-address-2" name="address_2" value="{{old('address_2') ? old('address_2') : $employee->address_2}}">
                    @if($errors->has('address_2'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('address_2')}}
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-employee-city">City @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('city') ? 'is-invalid' : ''}}" id="edit-employee-city" name="city" value="{{old('city') ? old('city') : $employee->city}}" required>
                    @if($errors->has('city'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('city')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-employee-state">State @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('state') ? 'is-invalid' : ''}}" id="edit-employee-state" name="state" required>
                        @if(!old('state'))
                        <option value="{{$employee->state}}" selected>{{$employee->state_full_name}}</option>
                        @endif
                        <option {{old('state') ? (old('state') === 'al' ? 'selected' : '') : ''}} value="al">Alabama</option>
                        <option {{old('state') ? (old('state') === 'ak' ? 'selected' : '') : ''}} value="ak">Alaska</option>
                        <option {{old('state') ? (old('state') === 'az' ? 'selected' : '') : ''}} value="az">Arizona</option>
                        <option {{old('state') ? (old('state') === 'ar' ? 'selected' : '') : ''}} value="ar">Arkansas</option>
                        <option {{old('state') ? (old('state') === 'ca' ? 'selected' : '') : ''}} value="ca">California</option>
                        <option {{old('state') ? (old('state') === 'co' ? 'selected' : '') : ''}} value="co">Colorado</option>
                        <option {{old('state') ? (old('state') === 'ct' ? 'selected' : '') : ''}} value="ct">Connecticut</option>
                        <option {{old('state') ? (old('state') === 'de' ? 'selected' : '') : ''}} value="de">Delaware</option>
                        <option {{old('state') ? (old('state') === 'dc' ? 'selected' : '') : ''}} value="dc">District Of Columbia</option>
                        <option {{old('state') ? (old('state') === 'fl' ? 'selected' : '') : ''}} value="fl">Florida</option>
                        <option {{old('state') ? (old('state') === 'ga' ? 'selected' : '') : ''}} value="ga">Georgia</option>
                        <option {{old('state') ? (old('state') === 'hi' ? 'selected' : '') : ''}} value="hi">Hawaii</option>
                        <option {{old('state') ? (old('state') === 'id' ? 'selected' : '') : ''}} value="id">Idaho</option>
                        <option {{old('state') ? (old('state') === 'il' ? 'selected' : '') : ''}} value="il">Illinois</option>
                        <option {{old('state') ? (old('state') === 'in' ? 'selected' : '') : ''}} value="in">Indiana</option>
                        <option {{old('state') ? (old('state') === 'ia' ? 'selected' : '') : ''}} value="ia">Iowa</option>
                        <option {{old('state') ? (old('state') === 'ks' ? 'selected' : '') : ''}} value="ks">Kansas</option>
                        <option {{old('state') ? (old('state') === 'ky' ? 'selected' : '') : ''}} value="ky">Kentucky</option>
                        <option {{old('state') ? (old('state') === 'la' ? 'selected' : '') : ''}} value="la">Louisiana</option>
                        <option {{old('state') ? (old('state') === 'me' ? 'selected' : '') : ''}} value="me">Maine</option>
                        <option {{old('state') ? (old('state') === 'md' ? 'selected' : '') : ''}} value="md">Maryland</option>
                        <option {{old('state') ? (old('state') === 'ma' ? 'selected' : '') : ''}} value="ma">Massachusetts</option>
                        <option {{old('state') ? (old('state') === 'mi' ? 'selected' : '') : ''}} value="mi">Michigan</option>
                        <option {{old('state') ? (old('state') === 'mn' ? 'selected' : '') : ''}} value="mn">Minnesota</option>
                        <option {{old('state') ? (old('state') === 'ms' ? 'selected' : '') : ''}} value="ms">Mississippi</option>
                        <option {{old('state') ? (old('state') === 'mo' ? 'selected' : '') : ''}} value="mo">Missouri</option>
                        <option {{old('state') ? (old('state') === 'mt' ? 'selected' : '') : ''}} value="mt">Montana</option>
                        <option {{old('state') ? (old('state') === 'ne' ? 'selected' : '') : ''}} value="ne">Nebraska</option>
                        <option {{old('state') ? (old('state') === 'nv' ? 'selected' : '') : ''}} value="nv">Nevada</option>
                        <option {{old('state') ? (old('state') === 'nh' ? 'selected' : '') : ''}} value="nh">New Hampshire</option>
                        <option {{old('state') ? (old('state') === 'nj' ? 'selected' : '') : ''}} value="nj">New Jersey</option>
                        <option {{old('state') ? (old('state') === 'nm' ? 'selected' : '') : ''}} value="nm">New Mexico</option>
                        <option {{old('state') ? (old('state') === 'ny' ? 'selected' : '') : ''}} value="ny">New York</option>
                        <option {{old('state') ? (old('state') === 'nc' ? 'selected' : '') : ''}} value="nc">North Carolina</option>
                        <option {{old('state') ? (old('state') === 'nd' ? 'selected' : '') : ''}} value="nd">North Dakota</option>
                        <option {{old('state') ? (old('state') === 'oh' ? 'selected' : '') : ''}} value="oh">Ohio</option>
                        <option {{old('state') ? (old('state') === 'ok' ? 'selected' : '') : ''}} value="ok">Oklahoma</option>
                        <option {{old('state') ? (old('state') === 'or' ? 'selected' : '') : ''}} value="or">Oregon</option>
                        <option {{old('state') ? (old('state') === 'pa' ? 'selected' : '') : ''}} value="pa">Pennsylvania</option>
                        <option {{old('state') ? (old('state') === 'ri' ? 'selected' : '') : ''}} value="ri">Rhode Island</option>
                        <option {{old('state') ? (old('state') === 'sc' ? 'selected' : '') : ''}} value="sc">South Carolina</option>
                        <option {{old('state') ? (old('state') === 'sd' ? 'selected' : '') : ''}} value="sd">South Dakota</option>
                        <option {{old('state') ? (old('state') === 'tn' ? 'selected' : '') : ''}} value="tn">Tennessee</option>
                        <option {{old('state') ? (old('state') === 'tx' ? 'selected' : '') : ''}} value="tx">Texas</option>
                        <option {{old('state') ? (old('state') === 'ut' ? 'selected' : '') : ''}} value="ut">Utah</option>
                        <option {{old('state') ? (old('state') === 'vt' ? 'selected' : '') : ''}} value="vt">Vermont</option>
                        <option {{old('state') ? (old('state') === 'va' ? 'selected' : '') : ''}} value="va">Virginia</option>
                        <option {{old('state') ? (old('state') === 'wa' ? 'selected' : '') : ''}} value="wa">Washington</option>
                        <option {{old('state') ? (old('state') === 'wv' ? 'selected' : '') : ''}} value="wv">West Virginia</option>
                        <option {{old('state') ? (old('state') === 'wi' ? 'selected' : '') : ''}} value="wi">Wisconsin</option>
                        <option {{old('state') ? (old('state') === 'wy' ? 'selected' : '') : ''}} value="wy">Wyoming</option>
                    </select>
                    @if($errors->has('state'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('state')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-employee-zip-code">Zip Code @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('zip_code') ? 'is-invalid' : ''}} is-number" id="edit-employee-zip-code" name="zip_code" value="{{old('zip_code') ? old('zip_code') : $employee->zip_code}}" required>
                    @if($errors->has('zip_code'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('zip_code')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-employee-county">County @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('county') ? 'is-invalid' : ''}}" id="edit-employee-county" name="county" value="{{old('county') ? old('county') : $employee->county}}" required>
                    @if($errors->has('county'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('county')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-employee-email">Email</label>
                    <input type="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" id="edit-employee-email" name="email" value="{{old('email') ? old('email') : $employee->email}}">
                    @if($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('email')}}
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-row card-deck mb-3">
                <div class="card card-status {{old('status') !== null ? (old('status') === '1' ? 'border-success' : 'border-danger') : ($employee->status === '1' ? 'border-success' : 'border-danger')}}">
                    <div class="card-header">Status @component('components.required-icon')@endComponent</div>
                    <div class="card-body">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input boolean-radio-button" type="radio" name="status" id="edit-employee-status-active" value="1" {{old('status') !== null ? (old('status') === '1' ? 'checked' : '') : ($employee->status === '1' ? 'checked' : '')}} required>
                            <label class="custom-control-label" for="edit-employee-status-active">
                            Active
                            </label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input boolean-radio-button" type="radio" name="status" id="edit-employee-status-inactive" value="0" {{old('status') !== null ? (old('status') === '0' ? 'checked' : '') : ($employee->status === '0' ? 'checked' : '')}} required>
                            <label class="custom-control-label" for="edit-employee-status-inactive">
                            Inactive
                            </label>
                        </div>
                        @if($errors->has('status'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('status')}}
                        </span>
                        @endif
                    </div>
                </div>

                <div class="card card-rehire {{old('rehire') !== null ? (old('rehire') === '1' ? 'border-success' : 'border-danger') : ($employee->rehire === '1' ? 'border-success' : 'border-danger')}}">
                    <div class="card-header">Rehire @component('components.required-icon')@endComponent</div>
                    <div class="card-body">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input boolean-radio-button" type="radio" name="rehire" id="edit-employee-rehire-yes" value="1" {{old('rehire') !== null ? (old('rehire') === '1' ? 'checked' : '') : ($employee->rehire === '1' ? 'checked' : '')}} required>
                            <label class="custom-control-label" for="edit-employee-rehire-yes">
                            Yes
                            </label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input boolean-radio-button" type="radio" name="rehire" id="edit-employee-rehire-no" value="0" {{old('rehire') !== null ? (old('rehire') === '0' ? 'checked' : '') : ($employee->rehire === '0' ? 'checked' : '')}} required>
                            <label class="custom-control-label" for="edit-employee-rehire-no">
                            No
                            </label>
                        </div>
                        @if($errors->has('rehire'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('rehire')}}
                        </span>
                    @endif
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Reviews</div>
                    <div class="card-body">
                        <div class="custom-control custom-checkbox employee-review-checkbox-div">
                            <input class="custom-control-input employee-review-checkbox" type="checkbox" name="thirty_day_review" id="edit-employee-thirty-day-review" value="1">
                            <input type="hidden" class="form-control employee-review-checkbox-hidden" name="thirty_day_review_hidden" id="edit-employee-thirty-day-review-hidden" value="{{old('thirty_day_review_hidden') ? old('thirty_day_review_hidden') : ($employee->thirty_day_review === '1' ? 'checked' : 'unchecked')}}">
                            <label class="custom-control-label" for="edit-employee-thirty-day-review">
                            Thirty Day {{old('thirty_day_review') ? 'old data' : 'new'}}
                            </label>
                        </div>
                        @if($errors->has('thirty_day_review'))
                            <span class="invalid-feedback" role="alert">
                                {{$errors->first('thirty_day_review')}}
                            </span>
                        @endif
                        <div class="custom-control custom-checkbox employee-review-checkbox-div">
                            <input class="custom-control-input employee-review-checkbox" type="checkbox" name="sixty_day_review" id="edit-employee-sixty-day-review" value="1" >
                            <input type="hidden" class="form-control employee-review-checkbox-hidden" name="sixty_day_review_hidden" id="edit-employee-sixty-day-review-hidden" value="{{old('sixty_day_review_hidden') ? old('sixty_day_review_hidden') : ($employee->sixty_day_review === '1' ? 'checked' : 'unchecked')}}">
                            <label class="custom-control-label" for="edit-employee-sixty-day-review">
                            Sixty Day
                            </label>
                        </div>
                        @if($errors->has('sixty_day_review'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('sixty_day_review')}}
                        </span>
                    @endif
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-lg-6">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input {{$errors->has('photo_link') ? 'is-invalid' : ''}}" id="edit-employee-photo" name="photo_link">
                        <label for="edit-employee-photo" class="custom-file-label {{$errors->has('photo_link') ? 'text-danger' : ''}}">
                        {{$errors->has('photo_link') ? $errors->first('photo_link') : 'Choose employee photo'}}
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="delete-employee-photo" name="delete_photo_link">
                        <label class="custom-control-label text-header" for="delete-employee-photo">
                            <i class="fas fa-long-arrow-alt-left fa-lg"></i> Check here to remove employee photo.
                        </label>
                    </div>
                </div>
            </div>

            <!-- ****************************************
            Bidding
            **************************************** -->
            <header class="alert alert-primary mt-4 h2" role="alert">
                <i class="fas fa-dolly"></i> Bidding
            </header>
            <div class="form-row">

                <div class="card card-status col-md-6 col-lg-4 {{old('bid_eligible') !== null ? (old('bid_eligible') === '1' ? 'border-success' : 'border-danger') : ($employee->bid_eligible === '1' ? 'border-success' : 'border-danger')}} p-0 ml-1 mr-1 mb-3">
                    <div class="card-header">Bid Eligible @component('components.required-icon')@endComponent</div>
                    <div class="card-body">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input boolean-radio-button" type="radio" name="bid_eligible" id="edit-employee-bid-eligible-active" value="1" {{old('bid_eligible') !== null ? (old('bid_eligible') === '1' ? 'checked' : '') : ($employee->bid_eligible === '1' ? 'checked' : '')}} required>
                            <label class="custom-control-label" for="edit-employee-bid-eligible-active">
                            Yes
                            </label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input boolean-radio-button" type="radio" name="bid_eligible" id="edit-employee-bid-eligible-inactive" value="0" {{old('bid_eligible') !== null ? (old('bid_eligible') === '0' ? 'checked' : '') : ($employee->bid_eligible === '0' ? 'checked' : '')}} required>
                            <label class="custom-control-label" for="edit-employee-bid-eligible-inactive">
                            No
                            </label>
                        </div>
                        @if($errors->has('bid_eligible'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('bid_eligible')}}
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-employee-bid-eligible-date">Bid Eligible Date</label>
                    <input type="text" class="form-control {{$errors->has('bid_eligible_date') ? 'is-invalid' : ''}} datepicker" id="edit-employee-bid-eligible-date" name="bid_eligible_date" value="{{old('bid_eligible_date') ? old('bid_eligible_date') : ($employee->bid_eligible_date == '' ? '' : $employee->bid_eligible_date->format('m/d/Y'))}}">
                    @if($errors->has('bid_eligible_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('bid_eligible_date')}}
                        </span>
                    @endif
                </div>

                <!-- <div class="form-group col-12">
                    <label for="edit-employee-bid-eligible-comment">Comments</label>
                    <textarea name="bid_eligible_comment" id="edit-employee-bid-eligible-comment" rows="3" class="form-control {{$errors->has('bid_eligible_comment') ? 'is-invalid' : ''}}">{{old('bid_eligible_comment') ? old('bid_eligible_comment') : $employee->bid_eligible_comment}}</textarea>
                    @if($errors->has('bid_eligible_comment'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('bid_eligible_comment')}}
                        </span>
                    @endif
                </div> -->

                <div class="form-group col-12">
                    <label for="edit-employee-bid-eligible-comment">Comment</label>
                    <input type="text" class="form-control {{$errors->has('bid_eligible_comment') ? 'is-invalid' : ''}}" id="edit-employee-bid-eligible-comment" name="bid_eligible_comment" value="{{old('bid_eligible_comment') ? old('bid_eligible_comment') : ''}}">
                    @if($errors->has('bid_eligible_comment'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('bid_eligible_comment')}}
                        </span>
                    @endif
                </div>

                @foreach($employee->bidEligibleComment as $bidEligibleComment)
                <div class="form-group col-12">
                    <label for="show-employee-bid-eligible-commen-{{$loop->iteration}}t">Comment {{$loop->iteration}}</label>
                    <input type="text" class="form-control" id="show-employee-bid-eligible-comment-{{$loop->iteration}}" name="bid_eligible_comment_{{$loop->iteration}}" value="{{$bidEligibleComment->comment}}" disabled>
                </div>
                @endforeach

            </div>

            <!-- ****************************************
            Occupation
            **************************************** -->
            <header class="alert alert-primary mt-4 h2" role="alert">
                <i class="fas fa-dolly"></i> Occupation
            </header>
            <div class="form-row">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-employee-job">Job @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('job') ? 'is-invalid' : ''}}" id="edit-employee-job" name="job" required>
                        @foreach($employee->job as $employeeJob)
                        <option {{old('job') ? (old('job') == $employeeJob->id ? 'selected' : '') : 'selected'}} value="{{$employeeJob->id}}">{{$employeeJob->description}}</option>
                        @endforeach
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
                    <label for="edit-employee-position">Position @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('position') ? 'is-invalid' : ''}}" id="edit-employee-position" name="position" required>
                        @foreach($employee->position as $employeePosition)
                        <option {{old('position') ? (old('position') == $employeePosition->id ? 'selected' : '') : 'selected'}} value="{{$employeePosition->id}}">{{$employeePosition->description}}</option>
                        @endforeach
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
                    <label for="edit-employee-cost-center">Cost Center @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('cost_center') ? 'is-invalid' : ''}}" id="edit-employee-cost-center" name="cost_center" required>
                        @foreach($employee->costCenter as $employeeCostCenter)
                        <option {{old('cost_center') ? (old('cost_center') == $employeeCostCenter->id ? 'selected' : '') : 'selected'}} value="{{$employeeCostCenter->id}}">{{$employeeCostCenter->number}}  {{$employeeCostCenter->extension}}  {{$employeeCostCenter->description}}</option>
                        @endforeach
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
                    <label for="edit-employee-shift">Shift @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('shift') ? 'is-invalid' : ''}}" id="edit-employee-shift" name="shift" required>
                        @foreach($employee->shift as $employeeShift)
                        <option {{old('shift') ? (old('shift') == $employeeShift->id ? 'selected' : '') : 'selected'}} value="{{$employeeShift->id}}">{{$employeeShift->description}}</option>
                        @endforeach
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
                    <label for="edit-employee-wage-title">Wage Title @component('components.required-icon')@endComponent</label>
                    <select name="wage_title" id="edit-employee-wage-title" class="custom-select {{$errors->has('wage_title') ? 'is-invalid' : ''}} choose-wage-title" required>
                        @foreach($employee->position as $employeePosition)
                        @foreach($employeePosition->wageTitle as $employeeWageTitle)
                        <option {{old('wage_title') ? (old('wage_title') == $employeeWageTitle->id ? 'selected' : '') : ''}} value="{{$employeeWageTitle->id}}">{{ucwords($employeeWageTitle->description)}}</option>
                        @endforeach
                        @endforeach
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
            <table class="table table-sm">
            <caption><button type="button" class="btn btn-outline-info clear-progression-events"> Clear Wage Events</button></caption>
                <thead class="bg-header text-light">
                    <tr>
                        <th><span class="d-none d-sm-block">Month</span><span class="d-sm-none">Mth</span></th>
                        <th><span class="d-none d-sm-block">Increase Date</span><span class="d-sm-none">Date</span></th>
                        <th><span class="d-none d-sm-block">Amount</span><span class="d-sm-none">Amt</span></th>
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
                        <td>
                            <input type="text" class="form-control col-12 col-lg-6 datepicker progression-event {{$errors->has('progression_event.'.$loop->iteration.'.date') ? 'is-invalid' : ''}}" id="edit-employee-progression-event-date-{{$loop->iteration}}" name="progression_event[{{$loop->iteration}}][date]" value="@if(old('progression_event')) {{old('progression_event.'.$loop->iteration.'.date')}} @else @foreach($employee->wageProgression as $employeeProgression){{$employeeProgression->id == $wageProgression->id ? $employeeProgression->pivot->date->format('m/d/Y') : ''}}@endforeach @endif">
                            <input hidden type="text" class="form-control col-12 col-lg-6" id="edit-employee-progression-event-id-{{$loop->iteration}}" name="progression_event[{{$loop->iteration}}][id]" value="{{$wageProgression->id}}">
                            @if($errors->has('progression_event.'.$loop->iteration.'.date'))
                            <span class="invalid-feedback" role="alert">
                                {{$errors->first('progression_event.'.$loop->iteration.'.date')}}
                            </span>
                            @endif
                        </td>
                        @foreach($wageTitles as $wageTitle)
                        @foreach($wageTitle->wageProgression as $wageTitleProgression)
                        @if($wageTitleProgression->id === $wageProgression->id)
                        <td class="{{$wageTitle->description}} wage-progression-row d-none">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="edit-employee-current-wage-{{$wageTitleProgression->pivot->id}}" name="current_wage" class="custom-control-input {{$errors->has('current_wage') ? 'is-invalid' : ''}}" value="{{$wageTitleProgression->pivot->id}}" {{old('current_wage') !== null ? (old('current_wage') == $wageTitleProgression->pivot->id ? 'checked' : '') : ($employee->current_wage == $wageTitleProgression->pivot->id ? 'checked' : '')}} required>
                                <label class="custom-control-label" for="edit-employee-current-wage-{{$wageTitleProgression->pivot->id}}">{{$wageTitleProgression->pivot->amount}}</label>
                            </div>
                        </td>
                        @endif
                        @endforeach
                        @endforeach
                    </tr>
                    @endforeach   
                </tbody>
            </table>

            <!-- ****************************************
            Phone Number
            is_primary is labeled as cell
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
                                <input type="radio" class="custom-control-input radio-select-primary" id="edit-employee-phone-number-primary-{{$loop->iteration}}" name="phone_number_is_primary" {{$oldPhoneNumber['number'] == old('phone_number_is_primary') ? 'checked' : ''}} value="{{$oldPhoneNumber['number']}}">
                                <label for="edit-employee-phone-number-primary-{{$loop->iteration}}" class="custom-control-label radio-select-primary-label">Cell</label>
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
                $phoneNumberCount = $employee->phoneNumber->count() + 1;
                @endphp
                @foreach($employee->phoneNumber as $employeePhoneNumber)
                <div class="col-lg-6 col-xxl-4 mb-3">
                    <label for="edit-employee-phone-number-{{$loop->iteration}}">Phone Number {{$loop->iteration}}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input radio-select-primary" id="edit-employee-phone-number-primary-{{$loop->iteration}}" name="phone_number_is_primary" {{$employeePhoneNumber->is_primary == '1' ? 'checked' : ''}} value="{{$employeePhoneNumber->number}}">
                                    <label class="custom-control-label radio-select-primary-label" for="edit-employee-phone-number-primary-{{$loop->iteration}}">Cell</label>
                                </div>
                            </div>
                        </div>
                        <input type="text" class="form-control phone-number-format {{$errors->has('phone_number.'.$loop->iteration.'.number') ? 'is-invalid' : ''}}" id="edit-employee-phone-number-{{$loop->iteration}}" name="phone_number[{{$loop->iteration}}][number]" value="{{$employeePhoneNumber->number}}" maxlength="12">
                        <input hidden type="text" class="form-control" id="edit-employee-phone-number-id-{{$loop->iteration}}" name="phone_number[{{$loop->iteration}}][id]" value="{{$employeePhoneNumber->id}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="edit-employee-phone-number-delete-{{$loop->iteration}}" name="phone_number[{{$loop->iteration}}][delete]" value="delete">
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

            @endif

            @for($phoneNumberCount; $phoneNumberCount < 6; $phoneNumberCount++)
                <div class="col-lg-6 col-xxl-4 mb-3">
                    <label for="edit-employee-phone-number-{{$phoneNumberCount}}">Phone Number {{$phoneNumberCount}}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input radio-select-primary" id="edit-employee-phone-number-primary-{{$phoneNumberCount}}" name="phone_number_is_primary" value="">
                                    <label class="custom-control-label radio-select-primary-label " for="edit-employee-phone-number-primary-{{$phoneNumberCount}}">Cell</label>
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
                                <input type="radio" class="custom-control-input radio-select-primary" id="edit-employee-emergency-contact-primary-{{$loop->iteration}}" name="emergency_contact_is_primary" {{$oldEmergencyContact['number'] == old('emergency_contact_is_primary') ? 'checked' : ''}} value="{{$oldEmergencyContact['number']}}">
                                <label for="edit-employee-emergency-contact-primary-{{$loop->iteration}}" class="custom-control-label radio-select-primary-label">Primary</label>
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
                $emergencyContactCount = $employee->emergencyContact->count() + 1;
                @endphp
                @foreach($employee->emergencyContact as $employeeEmergencyContact)
                <div class="col-xxl-6 mb-3">
                    <label for="edit-employee-emergency-contact-{{$loop->iteration}}">Emergency Contact {{$loop->iteration}} <span class="text-muted small">(number/name)</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input radio-select-primary" id="edit-employee-emergency-contact-primary-{{$loop->iteration}}" name="emergency_contact_is_primary" {{$employeeEmergencyContact->is_primary == '1' ? 'checked' : ''}} value="{{$employeeEmergencyContact->number}}">
                                    <label class="custom-control-label radio-select-primary-label" for="edit-employee-emergency-contact-primary-{{$loop->iteration}}">Primary</label>
                                </div>
                            </div>
                        </div>
                        <input type="text" class="form-control phone-number-format {{$errors->has('emergency_contact.'.$loop->iteration.'.number') ? 'is-invalid' : ''}}" id="edit-employee-emergency-contact-{{$loop->iteration}}" name="emergency_contact[{{$loop->iteration}}][number]" value="{{$employeeEmergencyContact->number}}" maxlength="12">
                        <input type="text" class="form-control {{$errors->has('emergency_contact.'.$loop->iteration.'.name') ? 'is-invalid' : ''}}" id="edit-employee-emergency-contact-name-{{$loop->iteration}}" name="emergency_contact[{{$loop->iteration}}][name]" value="{{$employeeEmergencyContact->name}}">
                        <input hidden type="text" class="form-control" id="edit-employee-emergency-contact-id-{{$loop->iteration}}" name="emergency_contact[{{$loop->iteration}}][id]" value="{{$employeeEmergencyContact->id}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="edit-employee-emergency-contact-delete-{{$loop->iteration}}" name="emergency_contact[{{$loop->iteration}}][delete]" value="delete">
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

            @endif

            @for($emergencyContactCount; $emergencyContactCount < 6; $emergencyContactCount++)
                <div class="col-xxl-6 mb-3">
                    <label for="edit-employee-emergency-contact-{{$emergencyContactCount}}">Emergency Contact {{$emergencyContactCount}} <span class="text-muted small">(number/name)</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input radio-select-primary" id="edit-employee-emergency-contact-primary-{{$emergencyContactCount}}" name="emergency_contact_is_primary" value="">
                                    <label class="custom-control-label radio-select-primary-label " for="edit-employee-emergency-contact-primary-{{$emergencyContactCount}}">Primary</label>
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

            <!-- ****************************************
            Disciplinary
            **************************************** -->
            <header class="alert alert-primary mt-4 h2" role="alert">
                <i class="fas fa-balance-scale"></i> Disciplinary
            </header>
            <a href="{{route('disciplinaries.create', ['employee' => $employee->id])}}" class="btn btn-create mb-3">Create New Disciplinary</a>
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
            <a href="{{route('terminations.create', ['employee' => $employee->id])}}" class="btn btn-create mb-3">Create New Termination</a>
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
                        <td class="employee-name">{{$employeeTermination->last_day->format('m/d/Y')}}</td>
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
            <a href="{{route('reductions.create', ['employee' => $employee->id])}}" class="btn btn-create mb-3">Create New Reduction</a>
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

            <button type="submit" class="btn btn-success" id="edit-employee-submit-button">Save Employee</button>
        </form>

        <hr class="my-4"></hr>
        <hr class="my-4"></hr>

@endsection