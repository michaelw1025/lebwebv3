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
            Create {{$employee->first_name}} {{$employee->last_name}} Termination
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{Route('terminations.store', ['employee' => $employee->id])}}" class="mt-2" id="create-termination-form" method="POST" autocomplete="off">
            @csrf
            <a href="{{route('employees.show', ['id' => $employee->id])}}" class="h3 text-primary my-4"><i class="fas fa-arrow-left"></i> Return To Show {{$employee->first_name}} {{$employee->last_name}}</a>

            <p class="text-danger mt-4">@component('components.required-icon')@endComponent indicates a required field</p>

            <div class="form-row mt-4">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-termination-type">Type @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('type') ? 'is-invalid' : ''}}" id="create-termination-type" name="type">
                        <option {{old('type') ? (old('type') == '' ? 'selected' : '') : ''}} value=""></option>
                        <option {{old('type') ? (old('type') == 'voluntary' ? 'selected' : '') : ''}} value="voluntary">Voluntary</option>
                        <option {{old('type') ? (old('type') == 'involuntary' ? 'selected' : '') : ''}} value="involuntary">Involuntary</option>
                    </select>
                    @if($errors->has('type'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('type')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-termination-date">Date @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control datepicker {{$errors->has('date') ? 'is-invalid' : ''}}" id="create-termination-date" name="date" value="{{old('date') ? old('date') : ''}}" autocomplete="off">
                    @if($errors->has('date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('date')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-termination-last-day">Last Day @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control datepicker {{$errors->has('last_day') ? 'is-invalid' : ''}}" id="create-termination-last-day" name="last_day" value="{{old('last_day') ? old('last_day') : ''}}" autocomplete="off">
                    @if($errors->has('last_day'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('last_day')}}
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-12">
                    <label for="create-termination-comments">Comments @component('components.required-icon')@endComponent</label>
                    <textarea name="comments" id="create-termination-comments" rows="3" class="form-control {{$errors->has('comments') ? 'is-invalid' : ''}}" >{{old('comments') ? old('comments') : ''}}</textarea>
                    @if($errors->has('comments'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('comments')}}
                        </span>
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-success" id="create-termination-submit-button">Create Termination</button>
        </form>

        <hr class="my-4"></hr>
        <hr class="my-4"></hr>

@endsection