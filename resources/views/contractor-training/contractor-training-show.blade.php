@extends('layouts.app')

@section('content')

        <!-- Title for content -->
        @component('components.content-title')
            @slot('textClass')
            text-primary
            @endslot

            @slot('fontStyle')
            fas
            @endslot

            @slot('fontIcon')
            fa-info-circle
            @endslot

            @slot('fontSize')
            fa-lg
            @endslot

            @slot('title')
            Show {{strtoupper($contractor->contractor_name)}} Employee: {{ucwords($contractorTraining->contractor_employee_name)}}
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="" class="mt-2" id="show-contractor-training-form" method="GET" autocomplete="off">
            @csrf
            <a href="{{route('contractors.show', ['id' => $contractor->id])}}" class="h3 text-primary my-4"><i class="fas fa-arrow-left"></i> Return To Show: {{strtoupper($contractor->contractor_name)}}</a>

            <div class="form-row mt-4">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-contractor-training-name">Contractor Employee Name</label>
                    <input type="text" class="form-control" id="show-contractor-training-name" name="contractor_employee_name" value="{{ucwords($contractorTraining->contractor_employee_name)}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-contractor-training-training-completion-date">Training Date</label>
                    <input type="text" class="form-control" id="show-contractor-training-training-completion-date" name="training_completion_date" value="{{$contractorTraining->training_completion_date->format('m/d/Y')}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-contractor-training-re-training-due-date">Re-Training Due Date</label>
                    <input type="text" class="form-control" id="show-contractor-training-re-training-due-date" name="re_training_due_date" value="{{$contractorTraining->re_training_due_date->format('m/d/Y')}}" disabled>
                </div>
                <div class="card col-md-6 col-lg-4 mb-3 card-active {{$contractorTraining->active === '1' ? 'border-success' : 'border-danger'}}">
                    <div class="card-header">Active</div>
                    <div class="card-body">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input boolean-radio-button" type="radio" name="active" id="show-contractor-training-active-yes" value="1" {{$contractorTraining->active === '1' ? 'checked' : ''}} disabled>
                            <label class="custom-control-label" for="show-contractor-training-active-yes">
                            Yes
                            </label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input boolean-radio-button" type="radio" name="active" id="edit-contractor-training-active-no" value="0" {{$contractorTraining->active === '0' ? 'checked' : ''}} disabled>
                            <label class="custom-control-label" for="show-contractor-training-active-no">
                            No
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{route('contractorTrainings.edit', ['id' => $contractorTraining->id, 'contractor' => $contractor->id])}}" class="btn btn-edit mt-4">Edit {{strtoupper($contractor->contractor_name)}} Employee</a>
        </form>

@endsection