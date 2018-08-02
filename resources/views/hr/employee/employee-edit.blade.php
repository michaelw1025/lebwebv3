@extends('layouts.app')

@section('content')

    @include('hr.sidebar')

    <article class="col-10 main-content-article">
        <h2 class="mt-2 text-edit"><i class="fas fa-user-edit fa-lg"></i>&nbsp Edit Employee</h2>
        <hr></hr>

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{Route('employees.update', $employee->id)}}" class="mt-2" id="edit-employee-form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('Patch')
            
            @if($employee->photo_link !== null)
            <img src="/storage/{{$employee->photo_link}}" alt="Employee Photo" class="img-thumbnail mb-2" width="100" height="100">
            @else
            <img src="/storage/unknown.png" alt="Employee Photo" class="img-thumbnail mb-2" width="100" height="100">
            @endif

            <p class="text-danger">@component('components.required-icon')@endComponent indicates a required field</p>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="edit-employee-first-name">First Name @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('first_name') ? 'is-invalid' : ''}}" id="edit-employee-first-name" name="first_name" value="{{old('first_name') ? old('first_name') : $employee->first_name}}"  autofocus>
                    @if($errors->has('first_name'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('first_name')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label for="edit-employee-last-name">Last Name @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('last_name') ? 'is-invalid' : ''}}" id="edit-employee-last-name" name="last_name" value="{{old('last_name') ? old('last_name') : $employee->last_name}}">
                    @if($errors->has('last_name'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('last_name')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label for="edit-employee-middle-initial">MI</label>
                    <input type="text" class="form-control {{$errors->has('middle_initial') ? 'is-invalid' : ''}}" id="edit-employee-middle-initial" name="middle_initial" value="{{old('middle_initial') ? old('middle_initial') : $employee->middle_initial}}">
                    @if($errors->has('middle_initial'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('middle_initial')}}
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="edit-employee-maiden-name">Maiden Name</label>
                    <input type="text" class="form-control {{$errors->has('maiden_name') ? 'is-invalid' : ''}}" id="edit-employee-maiden-name" name="maiden_name" value="{{old('maiden_name') ? old('maiden_name') : $employee->maiden_name}}">
                    @if($errors->has('maiden_name'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('maiden_name')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label for="edit-employee-nick-name">Nick Name</label>
                    <input type="text" class="form-control {{$errors->has('nick_name') ? 'is-invalid' : ''}}" id="edit-employee-nick-name" name="nick_name" value="{{old('nick_name') ? old('nick_name') : $employee->nick_name}}">
                    @if($errors->has('nick_name'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('nick_name')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label for="edit-employee-suffix">Sufix</label>
                    <select type="text" class="custom-select {{$errors->has('suffix') ? 'is-invalid' : ''}}" id="edit-employee-suffix" name="suffix">
                        @if(!old('suffix'))
                        <option value="{{$employee->suffix}}" selected>{{strtoupper($employee->suffix)}}</option>
                        @endif
                        <option {{old('suffix') ? (old('suffix') === '' ? 'selected' : '') : ''}} value=""></option>
                        <option {{old('suffix') ? (old('suffix') === 'mr' ? 'selected' : '') : ''}} value="mr">MR</option>
                        <option {{old('suffix') ? (old('suffix') === 'mrs' ? 'selected' : '') : ''}} value="mrs">MRS</option>
                        <option {{old('suffix') ? (old('suffix') === 'miss' ? 'selected' : '') : ''}} value="miss">MISS</option>
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
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="edit-employee-ssn">SSN @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('ssn') ? 'is-invalid' : ''}} ssn-format" id="edit-employee-ssn" name="ssn" value="{{old('ssn') ? old('ssn') : $employee->ssn}}"  maxlength="11">
                    @if($errors->has('ssn'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('ssn')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label for="edit-employee-gender">Gender @component('components.required-icon')@endComponent</label>
                    <select type="text" class="custom-select {{$errors->has('gender') ? 'is-invalid' : ''}}" id="edit-employee-gender" name="gender" value="">
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
                <div class="form-group col-md-4">
                    <label for="edit-employee-oracle-number">Oracle Number</label>
                    <input type="text" class="form-control {{$errors->has('oracle_number') ? 'is-invalid' : ''}} is-number" id="edit-employee-oracle-number" name="oracle_number" value="{{old('oracle_number') ? old('oracle_number') : $employee->oracle_number}}">
                    @if($errors->has('oracle_number'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('oracle_number')}}
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="edit-employee-birth-date">Birth Date @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('birth_date') ? 'is-invalid' : ''}} datepicker" id="edit-employee-birth-date" name="birth_date" value="{{old('birth_date') ? old('birth_date') : $employee->birth_date->format('m/d/Y')}}" >
                    @if($errors->has('birth_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('birth_date')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label for="edit-employee-hire-date">Hire Date @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('hire_date') ? 'is-invalid' : ''}} datepicker" id="edit-employee-hire-date" name="hire_date" value="{{old('hire_date') ? old('hire_date') : $employee->hire_date->format('m/d/Y')}}" >
                    @if($errors->has('hire_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('hire_date')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label for="edit-employee-service-date">Service Date @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('service_date') ? 'is-invalid' : ''}} datepicker" id="edit-employee-service-date" name="service_date" value="{{old('service_date') ? old('service_date') : $employee->service_date->format('m/d/Y')}}" >
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
                    <input type="text" class="form-control {{$errors->has('address_1') ? 'is-invalid' : ''}}" id="edit-employee-address-1" name="address_1" value="{{old('address_1') ? old('address_1') : $employee->address_1}}" >
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
                <div class="form-group col-md-6 col-lg-3">
                    <label for="edit-employee-city">City @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('city') ? 'is-invalid' : ''}}" id="edit-employee-city" name="city" value="{{old('city') ? old('city') : $employee->city}}" >
                    @if($errors->has('city'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('city')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-3">
                    <label for="edit-employee-state">State @component('components.required-icon')@endComponent</label>
                    <select type="text" class="custom-select {{$errors->has('state') ? 'is-invalid' : ''}}" id="edit-employee-state" name="state" value="" >
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
                <div class="form-group col-md-6 col-lg-3">
                    <label for="edit-employee-zip-code">Zip Code @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('zip_code') ? 'is-invalid' : ''}} is-number" id="edit-employee-zip-code" name="zip_code" value="{{old('zip_code') ? old('zip_code') : $employee->zip_code}}">
                    @if($errors->has('zip_code'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('zip_code')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-3">
                    <label for="edit-employee-county">County @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('county') ? 'is-invalid' : ''}}" id="edit-employee-county" name="county" value="{{old('county') ? old('county') : $employee->county}}" >
                    @if($errors->has('county'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('county')}}
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-row card-deck mb-3">
                <div class="card card-status {{old('status') !== null ? (old('status') === '1' ? 'border-success' : 'border-danger') : ($employee->status === '1' ? 'border-success' : 'border-danger')}}">
                    <div class="card-header">Status</div>
                    <div class="card-body">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input boolean-radio-button" type="radio" name="status" id="edit-employee-status-active" value="1" {{old('status') !== null ? (old('status') === '1' ? 'checked' : '') : ($employee->status === '1' ? 'checked' : '')}}>
                            <label class="custom-control-label" for="edit-employee-status-active">
                            Active
                            </label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input boolean-radio-button" type="radio" name="status" id="edit-employee-status-inactive" value="0" {{old('status') !== null ? (old('status') === '0' ? 'checked' : '') : ($employee->status === '0' ? 'checked' : '')}}>
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
                    <div class="card-header">Rehire</div>
                    <div class="card-body">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input boolean-radio-button" type="radio" name="rehire" id="edit-employee-rehire-yes" value="1" {{old('rehire') !== null ? (old('rehire') === '1' ? 'checked' : '') : ($employee->rehire === '1' ? 'checked' : '')}}>
                            <label class="custom-control-label" for="edit-employee-rehire-yes">
                            Yes
                            </label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input boolean-radio-button" type="radio" name="rehire" id="edit-employee-rehire-no" value="0" {{old('rehire') !== null ? (old('rehire') === '0' ? 'checked' : '') : ($employee->rehire === '0' ? 'checked' : '')}}>
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
                <div class="form-group col-md-6">
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
                        <label class="custom-control-label text-danger" for="delete-employee-photo">
                            <i class="fas fa-long-arrow-alt-left fa-lg"></i> Check here to remove employee photo.
                        </label>
                    </div>
                </div>
            </div>

            <header class="alert alert-primary mt-4" role="alert">
                Occupation
            </header>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="edit-employee-job">Job @component('components.required-icon')@endComponent</label>
                    <select type="text" class="custom-select {{$errors->has('job') ? 'is-invalid' : ''}}" id="edit-employee-job" name="job" value="">
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

                <div class="form-group col-md-4">
                    <label for="edit-employee-position">Position @component('components.required-icon')@endComponent</label>
                    <select type="text" class="custom-select {{$errors->has('position') ? 'is-invalid' : ''}}" id="edit-employee-position" name="position" value="">
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

                <div class="form-group col-md-4">
                    <label for="edit-employee-cost-center">Cost Center @component('components.required-icon')@endComponent</label>
                    <select type="text" class="custom-select {{$errors->has('cost_center') ? 'is-invalid' : ''}}" id="edit-employee-cost-center" name="cost_center" value="">
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

                <div class="form-group col-md-4">
                    <label for="edit-employee-shift">Shift @component('components.required-icon')@endComponent</label>
                    <select type="text" class="custom-select {{$errors->has('shift') ? 'is-invalid' : ''}}" id="edit-employee-shift" name="shift" value="">
                        @foreach($employee->shift as $employeeShift)
                        <option {{old('shift') ? (old('shift') == $employeeShift->id ? 'selected' : '') : 'selected'}} value="{{$employeeShift->id}}">{{$employeeShift->code}} - {{$employeeShift->description}}</option>
                        @endforeach
                        <option value=""></option>
                        @foreach($shifts as $shift)
                        <option {{old('shift') ? (old('shift') == $shift->id ? 'selected' : '') : ''}} value="{{$shift->id}}">{{$shift->code}} - {{$shift->description}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('shift'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('shift')}}
                        </span>
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-edit" id="edit-employee-submit-button">Save Employee</button>
        </form>

    </article>

@endsection