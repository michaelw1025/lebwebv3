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
            Create: Contractor
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{Route('contractors.store')}}" class="mt-2" id="create-contractor-form" method="POST" autocomplete="off">
            @csrf

            <p class="text-danger mt-4">@component('components.required-icon')@endComponent indicates a required field</p>

            <div class="form-row mt-4">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-contractor-name">Contractor Name @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('contractor_name') ? 'is-invalid' : ''}}" id="create-contractor-name" name="contractor_name" value="{{old('contractor_name')}}">
                    @if($errors->has('contractor_name'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('contractor_name')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-contractor-contact-name">Contact Person</label>
                    <input type="text" class="form-control {{$errors->has('contact_name') ? 'is-invalid' : ''}}" id="create-contractor-contact-name" name="contact_name" value="{{old('contact_name')}}">
                    @if($errors->has('contact_name'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('contact_name')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-contractor-contact-email">Contact Email</label>
                    <input type="email" class="form-control {{$errors->has('contact_email') ? 'is-invalid' : ''}}" id="create-contractor-contact-email" name="contact_email" value="{{old('contact_email')}}">
                    @if($errors->has('contact_email'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('contact_email')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-contractor-contact-phone-number">Contact Phone Number</label>
                    <input type="text" class="form-control phone-number-format {{$errors->has('contact_phone_number') ? 'is-invalid' : ''}}" id="create-contractor-contact-phone-number" name="contact_phone_number" value="{{old('contact_phone_number')}}" maxlength="12">
                    @if($errors->has('contact_phone_number'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('contact_phone_number')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-contractor-general-liability-insurance-date">Liability Ins Date</label>
                    <input type="text" class="form-control {{$errors->has('general_liability_insurance_date') ? 'is-invalid' : ''}} datepicker" id="create-contractor-general-liability-insurance-date" name="general_liability_insurance_date" value="{{old('general_liability_insurance_date')}}">
                    @if($errors->has('general_liability_insurance_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('general_liability_insurance_date')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-contractor-work-comp-employment-insurance-date">Work Comp Ins Date</label>
                    <input type="text" class="form-control {{$errors->has('work_comp_employment_insurance_date') ? 'is-invalid' : ''}} datepicker" id="create-contractor-work-comp-employment-insurance-date" name="work_comp_employment_insurance_date" value="{{old('work_comp_employment_insurance_date')}}">
                    @if($errors->has('work_comp_employment_insurance_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('work_comp_employment_insurance_date')}}
                        </span>
                    @endif
                </div>

            </div>

            <button type="submit" class="btn btn-success" id="create-contractor-submit-button">Create Contractor</button>
        </form>


@endsection