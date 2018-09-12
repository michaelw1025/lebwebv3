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
            Edit Contractor: {{strtoupper($contractor->contractor_name)}}
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{Route('contractors.update', $contractor->id)}}" class="mt-2" id="edit-contractor-form" method="POST" autocomplete="off">
            @csrf
            @method('Patch')
            <a href="{{route('contractors.show', ['id' => $contractor->id])}}" class="h3 text-primary my-4"><i class="fas fa-arrow-left"></i> Return To Show: {{strtoupper($contractor->contractor_name)}}</a>

            <p class="text-danger mt-4">@component('components.required-icon')@endComponent indicates a required field</p>

            <div class="form-row mt-4">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-contractor-name">Contractor Name @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('contractor_name') ? 'is-invalid' : ''}}" id="edit-contractor-name" name="contractor_name" value="{{old('contractor_name') ? old('contractor_name') : strtoupper($contractor->contractor_name)}}">
                    @if($errors->has('contractor_name'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('contractor_name')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-contractor-contact-name">Contact Person @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('contact_name') ? 'is-invalid' : ''}}" id="edit-contractor-contact-name" name="contact_name" value="{{old('contact_name') ? old('contact_name') : ucwords($contractor->contact_name)}}">
                    @if($errors->has('contact_name'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('contact_name')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-contractor-contact-email">Contact Email</label>
                    <input type="email" class="form-control {{$errors->has('contact_email') ? 'is-invalid' : ''}}" id="edit-contractor-contact-email" name="contact_email" value="{{old('contact_email') ? old('contact_email') : $contractor->contact_email}}">
                    @if($errors->has('contact_email'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('contact_email')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-contractor-contact-phone-number">Contact Phone Number</label>
                    <input type="text" class="form-control phone-number-format {{$errors->has('contact_phone_number') ? 'is-invalid' : ''}}" id="edit-contractor-contact-phone-number" name="contact_phone_number" value="{{old('contact_phone_number') ? old('contact_phone_number') : $contractor->contact_phone_number}}" maxlength="12">
                    @if($errors->has('contact_phone_number'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('contact_phone_number')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-contractor-general-liability-insurance-date">Liability Ins Date</label>
                    <input type="text" class="form-control {{$errors->has('general_liability_insurance_date') ? 'is-invalid' : ''}} datepicker" id="edit-contractor-general-liability-insurance-date" name="general_liability_insurance_date" value="{{old('general_liability_insurance_date') ? old('general_liability_insurance_date') : $contractor->general_liability_insurance_date->format('m/d/Y')}}">
                    @if($errors->has('general_liability_insurance_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('general_liability_insurance_date')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-contractor-work-comp-employment-insurance-date">Work Comp Ins Date</label>
                    <input type="text" class="form-control {{$errors->has('work_comp_employment_insurance_date') ? 'is-invalid' : ''}} datepicker" id="edit-contractor-work-comp-employment-insurance-date" name="work_comp_employment_insurance_date" value="{{old('work_comp_employment_insurance_date') ? old('work_comp_employment_insurance_date') : $contractor->work_comp_employment_insurance_date->format('m/d/Y')}}">
                    @if($errors->has('work_comp_employment_insurance_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('work_comp_employment_insurance_date')}}
                        </span>
                    @endif
                </div>
                
            </div>

            <button type="submit" class="btn btn-success" id="edit-contractor-submit-button">Save Contractor</button>
        </form>
        @if(Auth::user()->hasAnyRole(['admin', 'hrmanager', 'hruser', 'hrassistant']))
        <form action="{{Route('contractors.destroy', [$contractor->id])}}" class="mt-2" id="delete-contractor-form" method="POST">
            @csrf
            @method('Delete')
            <button type="submit" class="btn btn-outline-danger delete-item" id="delete-contractor-submit-button" name="contractor">Delete Contractor</button>
        </form>
        @endif

@endsection