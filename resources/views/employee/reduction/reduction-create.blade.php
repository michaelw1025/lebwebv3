@extends('layouts.app')

@section('content')

        <!-- Title for content -->
        @component('components.content-title')
            @slot('textClass')
            text-create
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
            Create {{$employee->first_name}} {{$employee->last_name}} Reduction
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{Route('reductions.store', ['employee' => $employee->id])}}" class="mt-2" id="create-reduction-form" method="POST" autocomplete="off">
            @csrf
            <a href="{{route('employees.show', ['id' => $employee->id])}}" class="h3 text-primary my-4"><i class="fas fa-arrow-left"></i> Return To Show {{$employee->first_name}} {{$employee->last_name}}</a>

            <p class="text-danger mt-4">@component('components.required-icon')@endComponent indicates a required field</p>

            <div class="form-row card-deck mt-4 mb-3">
                <div class="card bg-light card-currently_active">
                    <div class="card-header">Current Status @component('components.required-icon')@endComponent</div>
                    <div class="card-body">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input boolean-radio-button {{$errors->has('currently_active') ? 'is-invalid' : ''}}" type="radio" name="currently_active" id="create-reduction-currently-active" value="1" {{old('currently_active') !== null ? (old('currently_active') == '1' ? 'checked' : '') : ''}} required>
                            <label class="custom-control-label" for="create-reduction-currently-active">
                            Active
                            </label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input boolean-radio-button {{$errors->has('currently_active') ? 'is-invalid' : ''}}" type="radio" name="currently_active" id="create-reduction-currently-inactive" value="0" {{old('currently_active') ? (old('currently_active') == '0' ? 'checked' : '') : ''}} required>
                            <label class="custom-control-label" for="create-reduction-currently-inactive">
                            Inactive
                            </label>
                        </div>
                        @if($errors->has('currently_active'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('currently_active')}}
                        </span>
                        @endif
                    </div>
                </div>

                <div class="card bg-light ">
                    <div class="card-header">Type @component('components.required-icon')@endComponent</div>
                    <div class="card-body">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input {{$errors->has('type') ? 'is-invalid' : ''}}" type="radio" name="type" id="create-reduction-type-voluntary" value="voluntary" {{old('type') !== null ? (old('type') == 'voluntary' ? 'checked' : '') : ''}} required>
                            <label class="custom-control-label" for="create-reduction-type-voluntary">
                            Voluntary
                            </label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input {{$errors->has('type') ? 'is-invalid' : ''}}" type="radio" name="type" id="create-reduction-type-involuntary" value="involuntary" {{old('type') !== null ? (old('type') == 'involuntary' ? 'checked' : '') : ''}} required>
                            <label class="custom-control-label" for="create-reduction-type-involuntary">
                            Involuntary
                            </label>
                        </div>
                        @if($errors->has('type'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('type')}}
                        </span>
                        @endif
                    </div>
                </div>

                <div class="card bg-light ">
                    <div class="card-header">Displacement @component('components.required-icon')@endComponent</div>
                    <div class="card-body">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input displacement-radio-button {{$errors->has('displacement') ? 'is-invalid' : ''}}" type="radio" name="displacement" id="create-reduction-displacement-layoff" value="layoff" {{old('displacement') !== null ? (old('displacement') == 'layoff' ? 'checked' : '') : ''}} required>
                            <label class="custom-control-label" for="create-reduction-displacement-layoff">
                            Layoff
                            </label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input displacement-radio-button {{$errors->has('displacement') ? 'is-invalid' : ''}}" type="radio" name="displacement" id="create-reduction-displacement-bump" value="bump" {{old('displacement') !== null ? (old('displacement') == 'bump' ? 'checked' : '') : ''}} required>
                            <label class="custom-control-label" for="create-reduction-displacement-bump">
                            Bump
                            </label>
                        </div>
                        @if($errors->has('displacement'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('displacement')}}
                        </span>
                        @endif
                    </div>
                </div>

                
            </div>

            <div class="form-row">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-reduction-date">Date @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('date') ? 'is-invalid' : ''}} datepicker" id="create-reduction-date" name="date" value="{{old('date') ? old('date') : ''}}" required>
                    @if($errors->has('date'))
                    <span class="invalid-feedback" role="alert">
                        {{$errors->first('date')}}
                    </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-reduction-home-cost-center">Home Cost Center @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('home_cost_center') ? 'is-invalid' : ''}}" id="create-reduction-home-cost-center" name="home_cost_center" required>
                        <option></option>
                        @foreach($costCenters as $costCenter)
                        <option {{old('home_cost_center') ? (old('home_cost_center') == $costCenter->id ? 'selected' : '') : ''}} value="{{$costCenter->id}}">{{$costCenter->number}}  {{$costCenter->extension}}  {{$costCenter->description}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('home_cost_center'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('home_cost_center')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-reduction-bump-to-cost-center" class="required-with-bump-displacement">
                    Bump To Cost Center
                    @component('components.required-icon')@endComponent
                    </label>
                    <select class="custom-select {{$errors->has('bump_to_cost_center') ? 'is-invalid' : ''}}" id="create-reduction-bump-to-cost-center" name="bump_to_cost_center" >
                        <option></option>
                        @foreach($costCenters as $costCenter)
                        <option {{old('bump_to_cost_center') ? (old('bump_to_cost_center') == $costCenter->id ? 'selected' : '') : ''}} value="{{$costCenter->id}}">{{$costCenter->number}}  {{$costCenter->extension}}  {{$costCenter->description}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('bump_to_cost_center'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('bump_to_cost_center')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-reduction-home-shift">Home Shift @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('home_shift') ? 'is-invalid' : ''}}" id="create-reduction-home-shift" name="home_shift" required>
                        <option></option>
                        @foreach($shifts as $shift)
                        <option {{old('home_shift') ? (old('home_shift') == $shift->id ? 'selected' : '') : ''}} value="{{$shift->id}}">{{$shift->description}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('home_shift'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('home_shift')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-reduction-bump-to-shift" class="required-with-bump-displacement">
                    Bump To Shift
                    @component('components.required-icon')@endComponent
                    </label>
                    <select class="custom-select {{$errors->has('bump_to_shift') ? 'is-invalid' : ''}}" id="create-reduction-bump-to-shift" name="bump_to_shift">
                        <option></option>
                        @foreach($shifts as $shift)
                        <option {{old('bump_to_shift') ? (old('bump_to_shift') == $shift->id ? 'selected' : '') : ''}} value="{{$shift->id}}">{{$shift->description}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('bump_to_shift'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('bump_to_shift')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-reduction-fiscal-week">Fiscal Week @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('fiscal_week') ? 'is-invalid' : ''}}" id="create-reduction-fiscal-week" name="fiscal_week" value="{{old('fiscal_week') ? old('fiscal_week') : ''}}" required>
                    @if($errors->has('fiscal_week'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('fiscal_week')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-reduction-fiscal-year">Fiscal Year @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('fiscal_year') ? 'is-invalid' : ''}}" id="create-reduction-fiscal-year" name="fiscal_year" value="{{old('fiscal_year') ? old('fiscal_year') : ''}}" required>
                    @if($errors->has('fiscal_year'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('fiscal_year')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-reduction-return-date">Expected Return Date</label>
                    <input type="text" class="form-control {{$errors->has('return_date') ? 'is-invalid' : ''}} datepicker" id="create-reduction-return-date" name="return_date" value="{{old('return_date') ? old('return_date') : ''}}">
                    @if($errors->has('return_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('return_date')}}
                        </span>
                    @endif
                </div>
                
            </div>

            <div class="form-row">
                <div class="form-group col-12">
                    <label for="create-reduction-comments">Comments @component('components.required-icon')@endComponent</label>
                    <textarea name="comments" id="create-reduction-comments" rows="3" class="form-control {{$errors->has('comments') ? 'is-invalid' : ''}}" required>{{old('comments') ? old('comments') : ''}}</textarea>
                    @if($errors->has('comments'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('comments')}}
                        </span>
                    @endif
                </div>
            </div>


            
            <button type="submit" class="btn btn-success" id="create-reduction-submit-button">Create Create</button>
        </form>

        <hr class="my-4"></hr>
        <hr class="my-4"></hr>

@endsection