@extends('layouts.app')

@section('content')

    @include('hr.sidebar')

    <article class="col-10 main-content-article">
        <h2 class="mt-2 text-edit"><i class="fas fa-user-edit fa-lg"></i>&nbsp Edit {{$reduction->employee->first_name}} {{$reduction->employee->last_name}} Reduction</h2>
        <hr></hr>

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{Route('reductions.update', $reduction->id)}}" class="mt-2" id="edit-reduction-form" method="POST" autocomplete="off">
            @csrf
            @method('Patch')
            <a href="{{route('employees.show', ['id' => $reduction->employee->id])}}" class="h3 text-primary my-4"><i class="fas fa-arrow-left"></i> Return To Show {{$reduction->employee->first_name}} {{$reduction->employee->last_name}}</a>

            <p class="text-danger mt-4">@component('components.required-icon')@endComponent indicates a required field</p>



            <div class="form-row card-deck mt-4 mb-3">
                <div class="card bg-light {{$reduction->currently_active === '1' ? 'border-success' : 'border-danger'}} card-currently_active">
                    <div class="card-header">Current Status @component('components.required-icon')@endComponent</div>
                    <div class="card-body">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input boolean-radio-button {{$errors->has('currently_active') ? 'is-invalid' : ''}}" type="radio" name="currently_active" id="edit-reduction-currently-active" value="1" {{old('currently_active') !== null ? (old('currently_active') == '1' ? 'checked' : '') : ($reduction->currently_active == '1' ? 'checked' : '')}}>
                            <label class="custom-control-label" for="edit-reduction-currently-active">
                            Active
                            </label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input boolean-radio-button {{$errors->has('currently_active') ? 'is-invalid' : ''}}" type="radio" name="currently_active" id="edit-reduction-currently-inactive" value="0" {{old('currently_active') ? (old('currently_active') == '0' ? 'checked' : '') : ($reduction->currently_active == '0' ? 'checked' : '')}}>
                            <label class="custom-control-label" for="edit-reduction-currently-inactive">
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
                            <input class="custom-control-input {{$errors->has('type') ? 'is-invalid' : ''}}" type="radio" name="type" id="edit-reduction-type-voluntary" value="voluntary" {{old('type') !== null ? (old('type') == 'voluntary' ? 'checked' : '') : ($reduction->type == 'voluntary' ? 'checked' : '')}}>
                            <label class="custom-control-label" for="edit-reduction-type-voluntary">
                            Voluntary
                            </label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input {{$errors->has('type') ? 'is-invalid' : ''}}" type="radio" name="type" id="edit-reduction-type-involuntary" value="involuntary" {{old('type') !== null ? (old('type') == 'involuntary' ? 'checked' : '') : ($reduction->type == 'involuntary' ? 'checked' : '')}}>
                            <label class="custom-control-label" for="edit-reduction-type-involuntary">
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
                            <input class="custom-control-input displacement-radio-button {{$errors->has('displacement') ? 'is-invalid' : ''}}" type="radio" name="displacement" id="edit-reduction-displacement-layoff" value="layoff" {{old('displacement') !== null ? (old('displacement') == 'layoff' ? 'checked' : '') : ($reduction->displacement == 'layoff' ? 'checked' : '')}}>
                            <label class="custom-control-label" for="edit-reduction-displacement-layoff">
                            Layoff
                            </label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input displacement-radio-button {{$errors->has('displacement') ? 'is-invalid' : ''}}" type="radio" name="displacement" id="edit-reduction-displacement-bump" value="bump" {{old('displacement') !== null ? (old('displacement') == 'bump' ? 'checked' : '') : ($reduction->displacement == 'bump' ? 'checked' : '')}}>
                            <label class="custom-control-label" for="edit-reduction-displacement-bump">
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
                <div class="form-group col-md-4">
                    <label for="edit-reduction-date">Date @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('date') ? 'is-invalid' : ''}} datepicker" id="edit-reduction-date" name="date" value="{{old('date') ? old('date') : $reduction->date->format('m/d/Y')}}">
                    @if($errors->has('date'))
                    <span class="invalid-feedback" role="alert">
                        {{$errors->first('date')}}
                    </span>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label for="edit-reduction-home-cost-center">Home Cost Center @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('home_cost_center') ? 'is-invalid' : ''}}" id="edit-reduction-home-cost-center" name="home_cost_center">
                        @if(!old('home_cost_center'))
                        <option value="{{$reduction->home_cost_center}}" selected>{{$reduction->home_cost_center_number}} {{$reduction->home_cost_center_name}}</option>
                        @endif
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

                <div class="form-group col-md-4">
                    <label for="edit-reduction-bump-to-cost-center" class="required-with-bump-displacement">
                    Bump To Cost Center
                    @component('components.required-icon')@endComponent
                    </label>
                    <select class="custom-select {{$errors->has('bump_to_cost_center') ? 'is-invalid' : ''}}" id="edit-reduction-bump-to-cost-center" name="bump_to_cost_center">
                        @if(!old('bump_to_cost_center'))
                        <option value="{{$reduction->bump_to_cost_center}}" selected>{{$reduction->bump_to_cost_center_number}} {{$reduction->bump_to_cost_center_name}}</option>
                        @endif
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

                <div class="form-group col-md-4">
                    <label for="edit-reduction-home-shift">Home Shift @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('home_shift') ? 'is-invalid' : ''}}" id="edit-reduction-home-shift" name="home_shift">
                        @if(!old('home_shift'))
                        <option value="{{$reduction->home_shift}}" selected>{{$reduction->home_shift_name}}</option>
                        @endif
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

                <div class="form-group col-md-4">
                    <label for="edit-reduction-bump-to-shift" class="required-with-bump-displacement">
                    Bump To Shift
                    @component('components.required-icon')@endComponent
                    </label>
                    <select class="custom-select {{$errors->has('bump_to_shift') ? 'is-invalid' : ''}}" id="edit-reduction-bump-to-shift" name="bump_to_shift">
                        @if(!old('bump_to_shift'))
                        <option value="{{$reduction->bump_to_shift}}" selected>{{$reduction->bump_to_shift_name}}</option>
                        @endif
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

                <div class="form-group col-md-4">
                    <label for="edit-reduction-fiscal-week">Fiscal Week @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('fiscal_week') ? 'is-invalid' : ''}}" id="edit-reduction-fiscal-week" name="fiscal_week" value="{{old('fiscal_week') ? old('fiscal_week') : $reduction->fiscal_week}}">
                    @if($errors->has('fiscal_week'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('fiscal_week')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label for="edit-reduction-fiscal-year">Fiscal Year @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('fiscal_year') ? 'is-invalid' : ''}}" id="edit-reduction-fiscal-year" name="fiscal_year" value="{{old('fiscal_year') ? old('fiscal_year') : $reduction->fiscal_year}}">
                    @if($errors->has('fiscal_year'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('fiscal_year')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label for="edit-reduction-return-date">Expected Return Date</label>
                    <input type="text" class="form-control {{$errors->has('return_date') ? 'is-invalid' : ''}} datepicker" id="edit-reduction-return-date" name="return_date" value="{{old('return_date') ? old('return_date') : $reduction->return_date->format('m/d/Y')}}">
                    @if($errors->has('return_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('return_date')}}
                        </span>
                    @endif
                </div>
                
            </div>

            <div class="form-row">
                <div class="form-group col-12">
                    <label for="edit-reduction-comments">Comments @component('components.required-icon')@endComponent</label>
                    <textarea name="comments" id="edit-reduction-comments" rows="3" class="form-control {{$errors->has('comments') ? 'is-invalid' : ''}}">{{old('comments') ? old('comments') : $reduction->comments}}</textarea>
                    @if($errors->has('comments'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('comments')}}
                        </span>
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-success" id="edit-reduction-submit-button">Save Reduction</button>
        </form>
        <form action="{{Route('reductions.destroy', [$reduction->id, 'employee' => $reduction->employee->id])}}" class="mt-2" id="delete-reduction-form" method="POST">
            @csrf
            @method('Delete')
            <button type="submit" class="btn btn-outline-danger delete-item" id="delete-reduction-submit-button" name="reduction">Delete Reduction</button>
        </form>

        <hr class="my-4"></hr>
        <hr class="my-4"></hr>

    </article>

@endsection