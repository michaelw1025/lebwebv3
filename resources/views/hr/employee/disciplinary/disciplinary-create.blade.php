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
            Create {{$employee->first_name}} {{$employee->last_name}} Disciplinary
            @endslot

            @slot('displayExport')
            d-none
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{Route('disciplinaries.store', ['employee' => $employee->id])}}" class="mt-2" id="create-disciplinary-form" method="POST" autocomplete="off">
            @csrf
            <a href="{{route('employees.show', ['id' => $employee->id])}}" class="h3 text-primary my-4"><i class="fas fa-arrow-left"></i> Return To Show {{$employee->first_name}} {{$employee->last_name}}</a>

            <p class="text-danger mt-4">@component('components.required-icon')@endComponent indicates a required field</p>

            <div class="form-row mt-4">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-disciplinary-type">Type @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('type') ? 'is-invalid' : ''}}" id="create-disciplinary-type" name="type">
                        <option {{old('type') ? (old('type') == '' ? 'selected' : '') : ''}} value=""></option>
                        <option {{old('type') ? (old('type') == 'attendance' ? 'selected' : '') : ''}} value="attendance">Attendance</option>
                        <option {{old('type') ? (old('type') == 'performance' ? 'selected' : '') : ''}} value="performance">Performance</option>
                    </select>
                    @if($errors->has('type'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('type')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-disciplinary-level">Level @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('level') ? 'is-invalid' : ''}}" id="create-disciplinary-level" name="level">
                        <option {{old('level') ? (old('level') == '' ? 'selected' : '') : ''}} value=""></option>
                        <option {{old('level') ? (old('level') == 'first' ? 'selected' : '') : ''}} value="first">First</option>
                        <option {{old('level') ? (old('level') == 'second' ? 'selected' : '') : ''}} value="second">Second</option>
                        <option {{old('level') ? (old('level') == 'final' ? 'selected' : '') : ''}} value="final">Final</option>
                        <option {{old('level') ? (old('level') == 'hr review' ? 'selected' : '') : ''}} value="hr review">HR Review</option>
                        <option {{old('level') ? (old('level') == '2nd hr review' ? 'selected' : '') : ''}} value="2nd hr review">2nd HR Review</option>
                        <option {{old('level') ? (old('level') == 'discussion' ? 'selected' : '') : ''}} value="discussion">Discussion</option>
                    </select>
                    @if($errors->has('level'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('level')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-disciplinary-date">Date @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control datepicker {{$errors->has('date') ? 'is-invalid' : ''}}" id="create-disciplinary-date" name="date" value="{{old('date') ? old('date') : ''}}" autocomplete="off">
                    @if($errors->has('date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('date')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-disciplinary-cost-center">Cost Center @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('cost_center') ? 'is-invalid' : ''}}" id="create-disciplinary-cost-center" name="cost_center">
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
                    <label for="create-disciplinary-issued-by">Issued By @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('issued_by') ? 'is-invalid' : ''}}" id="create-disciplinary-issued-by" name="issued_by">
                        <option value=""></option>
                        @foreach($salariedEmployees as $salariedEmployee)
                        <option {{old('issued_by') ? (old('issued_by') == $salariedEmployee->id ? 'selected' : '') : ''}} value="{{$salariedEmployee->id}}">{{$salariedEmployee->first_name}} {{$salariedEmployee->last_name}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('issued_by'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('issued_by')}}
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-12">
                    <label for="create-disciplinary-comments">Comments @component('components.required-icon')@endComponent</label>
                    <textarea name="comments" id="create-disciplinary-comments" rows="3" class="form-control {{$errors->has('comments') ? 'is-invalid' : ''}}" >{{old('comments') ? old('comments') : ''}}</textarea>
                    @if($errors->has('comments'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('comments')}}
                        </span>
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-success" id="create-disciplinary-submit-button">Create Disciplinary</button>
        </form>

        <hr class="my-4"></hr>
        <hr class="my-4"></hr>

@endsection