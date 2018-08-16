@extends('layouts.app')

@section('content')

    @include('hr.sidebar')

    <article class="col-10 main-content-article">
        <h2 class="mt-2 text-edit"><i class="fas fa-user-edit fa-lg"></i>&nbsp Edit {{$disciplinary->employee->first_name}} {{$disciplinary->employee->last_name}} Disciplinary</h2>
        <hr></hr>

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{Route('disciplinaries.update', $disciplinary->id)}}" class="mt-2" id="edit-disciplinary-form" method="POST" autocomplete="off">
            @csrf
            @method('Patch')
            <a href="{{route('employees.show', ['id' => $disciplinary->employee->id])}}" class="h3 text-primary my-4"><i class="fas fa-arrow-left"></i> Return To Show {{$disciplinary->employee->first_name}} {{$disciplinary->employee->last_name}}</a>

            <p class="text-danger mt-4">@component('components.required-icon')@endComponent indicates a required field</p>

            <div class="form-row mt-4">
                <div class="form-group col-md-4">
                    <label for="edit-disciplinary-type">Type @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('type') ? 'is-invalid' : ''}}" id="edit-disciplinary-type" name="type">
                        @if(!old('type'))
                        <option value="{{$disciplinary->type}}" selected>{{ucwords($disciplinary->type)}}</option>
                        @endif
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
                <div class="form-group col-md-4">
                    <label for="edit-disciplinary-level">Level @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('level') ? 'is-invalid' : ''}}" id="edit-disciplinary-level" name="level">
                        @if(!old('level'))
                        <option value="{{$disciplinary->level}}" selected>{{ucwords($disciplinary->level)}}</option>
                        @endif
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
                <div class="form-group col-md-4">
                    <label for="edit-disciplinary-date">Date @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control datepicker {{$errors->has('date') ? 'is-invalid' : ''}}" id="edit-disciplinary-date" name="date" value="{{old('date') ? old('date') : $disciplinary->date->format('m/d/Y')}}">
                    @if($errors->has('date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('date')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label for="edit-disciplinary-cost-center">Cost Center @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('cost_center') ? 'is-invalid' : ''}}" id="edit-disciplinary-cost-center" name="cost_center">
                        @if(!old('cost_center'))
                        <option value="{{$disciplinary->cost_center}}" selected>{{$disciplinary->cost_center_number}} {{$disciplinary->cost_center_name}}</option>
                        @endif
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
                    <label for="edit-disciplinary-issued-by">Issued By @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('issued_by') ? 'is-invalid' : ''}}" id="edit-disciplinary-issued-by" name="issued_by">
                        @if(!old('issued_by'))
                        <option value="{{$disciplinary->issued_by}}" selected>{{$disciplinary->issuer_name}}</option>
                        @endif
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
                    <label for="edit-disciplinary-comments">Comments @component('components.required-icon')@endComponent</label>
                    <textarea name="comments" id="edit-disciplinary-comments" rows="3" class="form-control {{$errors->has('comments') ? 'is-invalid' : ''}}" >{{old('comments') ? old('comments') : $disciplinary->comments}}</textarea>
                    @if($errors->has('comments'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('comments')}}
                        </span>
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-success" id="edit-disciplinary-submit-button">Save Disciplinary</button>
        </form>
        <form action="{{Route('disciplinaries.destroy', [$disciplinary->id, 'employee' => $disciplinary->employee->id])}}" class="mt-2" id="delete-disciplinary-form" method="POST">
            @csrf
            @method('Delete')
            <button type="submit" class="btn btn-outline-danger delete-item" id="delete-disciplinary-submit-button" name="disciplinary">Delete Disciplinary</button>
        </form>

        <hr class="my-4"></hr>
        <hr class="my-4"></hr>

    </article>

@endsection