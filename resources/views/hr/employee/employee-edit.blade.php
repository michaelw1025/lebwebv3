@extends('layouts.app')

@section('content')

    @include('hr.sidebar')

    <article class="col-10 main-content-article">
        <h2 class="mt-2 text-primary"><i class="fas fa-user-edit fa-lg"></i>&nbsp Edit Employee</h2>
        <hr></hr>

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{Route('employees.update', $employee->id)}}" class="mt-2" id="edit-employee-form" method="POST">
            @csrf
            @method('Patch')
            <p class="text-danger">@component('components.required-icon')@endComponent indicates a required field</p>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="edit-employee-first-name">First Name @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('first_name') ? 'is-invalid' : ''}}" id="edit-employee-first-name" name="first_name" value="{{old('first_name') !== null ? old('first_name') : $employee->first_name}}"  autofocus>
                    @if($errors->has('first_name'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('first_name')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label for="edit-employee-last-name">Last Name @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('last_name') ? 'is-invalid' : ''}}" id="edit-employee-last-name" name="last_name" value="{{old('last_name') !== null ? old('last_name') : $employee->last_name}}">
                    @if($errors->has('last_name'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('last_name')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label for="edit-employee-middle-initial">MI</label>
                    <input type="text" class="form-control {{$errors->has('middle_initial') ? 'is-invalid' : ''}}" id="edit-employee-middle-initial" name="middle_initial" value="{{old('middle_initial') !== null ? old('middle_initial') : $employee->middle_initial}}">
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
                    <input type="text" class="form-control {{$errors->has('maiden_name') ? 'is-invalid' : ''}}" id="edit-employee-maiden-name" name="maiden_name" value="{{old('maiden_name') !== null ? old('maiden_name') : $employee->maiden_name}}">
                    @if($errors->has('maiden_name'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('maiden_name')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label for="edit-employee-nick-name">Nick Name</label>
                    <input type="text" class="form-control {{$errors->has('nick_name') ? 'is-invalid' : ''}}" id="edit-employee-nick-name" name="nick_name" value="{{old('nick_name') !== null ? old('nick_name') : $employee->nick_name}}">
                    @if($errors->has('nick_name'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('nick_name')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label for="edit-employee-suffix">Sufix</label>
                    <select type="text" class="form-control {{$errors->has('suffix') ? 'is-invalid' : ''}}" id="edit-employee-suffix" name="suffix" value="{{old('suffix')}}">
                        <option value="{{$employee->suffix}}">{{strtoupper($employee->suffix)}}</option>
                        <option value=""></option>
                        <option value="mr">Mr</option>
                        <option value="mrs">Mrs</option>
                        <option value="miss">Miss</option>
                        <option value="jr">Jr</option>
                        <option value="sr">Sr</option>
                        <option value="ii">II</option>
                        <option value="iii">III</option>
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
                    <input type="text" class="form-control {{$errors->has('ssn') ? 'is-invalid' : ''}} ssn-format" id="edit-employee-ssn" name="ssn" value="{{old('ssn')}}"  maxlength="11">
                    @if($errors->has('ssn'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('ssn')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label for="edit-employee-gender">Gender @component('components.required-icon')@endComponent</label>
                    <select type="text" class="form-control {{$errors->has('gender') ? 'is-invalid' : ''}}" id="edit-employee-gender" name="gender" value="{{old('gender')}}" >
                        <option value=""></option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                        <option value="none">None</option>
                    </select>
                    @if($errors->has('gender'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('gender')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label for="edit-employee-oracle-number">Oracle Number</label>
                    <input type="text" class="form-control {{$errors->has('oracle_number') ? 'is-invalid' : ''}} is-number" id="edit-employee-oracle-number" name="oracle_number" value="{{old('oracle_number')}}">
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
                    <input type="text" class="form-control {{$errors->has('birth_date') ? 'is-invalid' : ''}} datepicker" id="edit-employee-birth-date" name="birth_date" value="{{old('birth_date')}}" >
                    @if($errors->has('birth_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('birth_date')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label for="edit-employee-hire-date">Hire Date @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('hire_date') ? 'is-invalid' : ''}} datepicker" id="edit-employee-hire-date" name="hire_date" value="{{old('hire_date')}}" >
                    @if($errors->has('hire_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('hire_date')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label for="edit-employee-service-date">Service Date @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('service_date') ? 'is-invalid' : ''}} datepicker" id="edit-employee-service-date" name="service_date" value="{{old('service_date')}}" >
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
                    <input type="text" class="form-control {{$errors->has('address_1') ? 'is-invalid' : ''}}" id="edit-employee-address-1" name="address_1" value="{{old('address_1')}}" >
                    @if($errors->has('address_1'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('address_1')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="edit-employee-address-2">Address Cont.</label>
                    <input type="text" class="form-control {{$errors->has('address_2') ? 'is-invalid' : ''}}" id="edit-employee-address-2" name="address_2" value="{{old('address_2')}}">
                    @if($errors->has('address_2'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('address_2')}}
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4 col-lg-3">
                    <label for="edit-employee-city">City @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('city') ? 'is-invalid' : ''}}" id="edit-employee-city" name="city" value="{{old('city')}}" >
                    @if($errors->has('city'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('city')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-4 col-lg-3">
                    <label for="edit-employee-state">State @component('components.required-icon')@endComponent</label>
                    <select type="text" class="form-control {{$errors->has('state') ? 'is-invalid' : ''}}" id="edit-employee-state" name="state" value="{{old('state')}}" >
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
                        <option value="mo">Missouri</option>
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
                <div class="form-group col-md-4 col-lg-3">
                    <label for="edit-employee-zip-code">Zip Code @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('zip_code') ? 'is-invalid' : ''}} is-number" id="edit-employee-zip-code" name="zip_code" value="{{old('zip_code')}}" >
                    @if($errors->has('zip_code'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('zip_code')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-4 col-lg-3">
                    <label for="edit-employee-county">County @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('county') ? 'is-invalid' : ''}}" id="edit-employee-county" name="county" value="{{old('county')}}" >
                    @if($errors->has('county'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('county')}}
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-row">

            </div>
            <button type="submit" class="btn btn-primary" id="edit-employee-submit-button">Save Employee</button>
        </form>

    </article>

@endsection