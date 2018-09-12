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
            Show Contractor: {{strtoupper($contractor->contractor_name)}}
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="" class="mt-2" id="show-contractor-form" method="GET" autocomplete="off">
            @csrf

            <div class="form-row mt-4">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-contractor-name">Contractor Name</label>
                    <input type="text" class="form-control" id="show-contractor-name" name="contractor_name" value="{{strtoupper($contractor->contractor_name)}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-contractor-contact-name">Contact Person</label>
                    <input type="text" class="form-control" id="show-contractor-contact-name" name="contact_name" value="{{ucwords($contractor->contact_name)}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-contractor-contact-email">Contact Email</label>
                    <input type="text" class="form-control" id="show-contractor-contact-email" name="contact_email" value="{{$contractor->contact_email}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-contractor-contact-phone-number">Contact Phone Number</label>
                    <input type="text" class="form-control phone-number-format" id="show-contractor-contact-phone-number" name="contact_phone_number" value="{{$contractor->contact_phone_number}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-contractor-general-liability-insurance-date">Liability Ins Date</label>
                    <input type="text" class="form-control" id="show-contractor-general-liability-insurance-date" name="general_liability_insurance_date" value="{{$contractor->general_liability_insurance_date->format('m/d/Y')}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-contractor-work-comp-employment-insurance-date">Work Comp Ins Date</label>
                    <input type="text" class="form-control" id="show-contractor-work-comp-employment-insurance-date" name="work_comp_employment_insurance_date" value="{{$contractor->work_comp_employment_insurance_date->format('m/d/Y')}}" disabled>
                </div>
            </div>

            <a href="{{route('contractors.edit', $contractor->id)}}" class="btn btn-edit mt-4">Edit Contractor</a>
        </form>

        <table class="table table-sm table-hover table-striped table-borderless mt-5">
            <thead class="bg-platinum text-dark">
                <tr>
                    <th scope="col" colspan="4" class="text-center">Contractor Employees</th>
                </tr>
            </thead>
            <thead class="bg-header text-light">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Training Date</th>
                    <th scope="col">Re-Training Date</th>
                    <th scope="col">Active</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contractor->contractorTraining as $contractorEmployee)
                <tr class="clickable-row employee-row" data-href="{{route('contractorTrainings.show', ['id' => $contractorEmployee->id, 'contractor' => $contractor->id])}}">
                    <td>{{ucwords($contractorEmployee->contractor_employee_name)}}</td>
                    <td>{{$contractorEmployee->training_completion_date->format('m/d/Y')}}</td>
                    <td>{{$contractorEmployee->re_training_due_date->format('m/d/Y')}}</td>
                    <td>{{$contractorEmployee->active == 1 ? 'Yes' : 'No'}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{route('contractorTrainings.create', ['contractor' => $contractor->id])}}" class="btn btn-create mb-3">Create New {{strtoupper($contractor->contractor_name)}} Employee</a>

@endsection