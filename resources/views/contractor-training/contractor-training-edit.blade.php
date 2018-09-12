@extends('layouts.app')

@section('content')

        <!-- Title for content -->
        @component('components.content-title')
            @slot('textClass')
            text-edit
            @endslot

            @slot('fontStyle')
            far
            @endslot

            @slot('fontIcon')
            fa-edit
            @endslot

            @slot('fontSize')
            fa-lg
            @endslot

            @slot('title')
            Edit {{strtoupper($contractor->contractor_name)}} Employee: {{ucwords($contractorTraining->contractor_employee_name)}}
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{Route('contractorTrainings.update', ['id' => $contractorTraining->id, 'contractor' => $contractor->id])}}" class="mt-2" id="edit-contractor-form" method="POST" autocomplete="off">
            @csrf
            @method('Patch')
            <a href="{{route('contractors.show', ['id' => $contractor->id])}}" class="h3 text-primary my-4"><i class="fas fa-arrow-left"></i> Return To Show: {{strtoupper($contractor->contractor_name)}}</a>

            <p class="text-danger mt-4">@component('components.required-icon')@endComponent indicates a required field</p>

            <div class="form-row mt-4">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-contractor-training-name">Contractor Employee Name @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('contractor_employee_name') ? 'is-invalid' : ''}}" id="edit-contractor-training-name" name="contractor_employee_name" value="{{old('contractor_employee_name') ? old('contractor_employee_name') : ucwords($contractorTraining->contractor_employee_name)}}">
                    @if($errors->has('contractor_employee_name'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('contractor_employee_name')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-contractor-training-training-completion-date">Training Date</label>
                    <input type="text" class="form-control {{$errors->has('training_completion_date') ? 'is-invalid' : ''}} datepicker" id="edit-contractor-training-training-completion-date" name="training_completion_date" value="{{old('training_completion_date') ? old('training_completion_date') : $contractorTraining->training_completion_date->format('m/d/Y')}}" placeholder="Default to today's date.">
                    @if($errors->has('training_completion_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('training_completion_date')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-contractor-training-re-training-due-date">Re-Training Date</label>
                    <input type="text" class="form-control {{$errors->has('re_training_due_date') ? 'is-invalid' : ''}} datepicker" id="edit-contractor-training-re-training-due-date" name="re_training_due_date" value="{{old('re_training_due_date') ? old('re_training_due_date') : $contractorTraining->re_training_due_date->format('m/d/Y')}}" placeholder="Default to today's date.">
                    @if($errors->has('re_training_due_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('re_training_due_date')}}
                        </span>
                    @endif
                </div>

                <div class="card col-md-6 col-lg-4 mb-3 card-active {{old('active') !== null ? (old('active') === '1' ? 'border-success' : 'border-danger') : ($contractorTraining->active === '1' ? 'border-success' : 'border-danger')}}">
                    <div class="card-header">Active @component('components.required-icon')@endComponent</div>
                    <div class="card-body">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input boolean-radio-button" type="radio" name="active" id="edit-contractor-training-active-yes" value="1" {{old('active') !== null ? (old('active') === '1' ? 'checked' : '') : ($contractorTraining->active === '1' ? 'checked' : '')}}>
                            <label class="custom-control-label" for="edit-contractor-training-active-yes">
                            Yes
                            </label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input boolean-radio-button" type="radio" name="active" id="edit-contractor-training-active-no" value="0" {{old('active') !== null ? (old('active') === '0' ? 'checked' : '') : ($contractorTraining->active === '0' ? 'checked' : '')}}>
                            <label class="custom-control-label" for="edit-contractor-training-active-no">
                            No
                            </label>
                        </div>
                        @if($errors->has('active'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('active')}}
                        </span>
                    @endif
                    </div>
                </div>
                
            </div>

            <button type="submit" class="btn btn-success" id="edit-contractor-training-submit-button">Save {{strtoupper($contractor->contractor_name)}} Employee</button>
        </form>
        @if(Auth::user()->hasAnyRole(['admin', 'hrmanager', 'hruser', 'hrassistant']))
        <form action="{{Route('contractorTrainings.destroy', ['id' => $contractorTraining->id, 'contractor' => $contractor->id])}}" class="mt-2" id="delete-contractor-training-form" method="POST">
            @csrf
            @method('Delete')
            <button type="submit" class="btn btn-outline-danger delete-item" id="delete-contractor-training-submit-button" name="contractor employee">Delete {{strtoupper($contractor->contractor_name)}} Employee</button>
        </form>
        @endif

@endsection