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
            fa-drafting-compass
            @endslot

            @slot('fontSize')
            fa-lg
            @endslot

            @slot('title')
            Create: {{strtoupper($contractor->contractor_name)}} Employee
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{Route('contractorTrainings.store', ['contractor' => $contractor->id])}}" class="mt-2" id="create-contractor-training-form" method="POST" autocomplete="off">
            @csrf
            <a href="{{route('contractors.show', ['id' => $contractor->id])}}" class="h3 text-primary my-4"><i class="fas fa-arrow-left"></i> Return To Show: {{strtoupper($contractor->contractor_name)}}</a>

            <p class="text-danger mt-4">@component('components.required-icon')@endComponent indicates a required field</p>

            <div class="form-row mt-4">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-contractor-training-name">Contractor Employee Name @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('contractor_employee_name') ? 'is-invalid' : ''}}" id="create-contractor-name" name="contractor_employee_name" value="{{old('contractor_employee_name')}}" required>
                    @if($errors->has('contractor_employee_name'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('contractor_employee_name')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-contractor-training-training-completion-date">Training Date</label>
                    <input type="text" class="form-control {{$errors->has('training_completion_date') ? 'is-invalid' : ''}} datepicker" id="create-contractor-training-training-completion-date" name="training_completion_date" value="{{old('training_completion_date')}}" placeholder="Default to today's date.">
                    @if($errors->has('training_completion_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('training_completion_date')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-contractor-training-re-training-due-date">Re-Training Due Date</label>
                    <input type="text" class="form-control {{$errors->has('re_training_due_date') ? 'is-invalid' : ''}} datepicker" id="create-contractor-training-re-training-due-date" name="re_training_due_date" value="{{old('re_training_due_date')}}" placeholder="Default to today's date.">
                    @if($errors->has('re_training_due_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('re_training_due_date')}}
                        </span>
                    @endif
                </div>

            </div>

            <button type="submit" class="btn btn-success" id="create-contractor-training-submit-button">Create Contractor Employee</button>
        </form>


@endsection