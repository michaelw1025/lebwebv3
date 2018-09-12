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
            fa-clipboard-check
            @endslot

            @slot('fontSize')
            fa-lg
            @endslot

            @slot('title')
            Contractors
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <a href="{{route('contractors.create')}}" class="btn btn-create mb-3">Create New Contractor</a>

        <table class="table table-sm table-hover table-striped table-borderless">
            <thead class="bg-header text-light">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col" class="d-none d-md-table-cell">Liability Ins</th>
                    <th scope="col" class="d-none d-md-table-cell">Work Comp</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contractors as $contractor)
                <tr class="clickable-row" data-href="{{route('contractors.show', ['id' => $contractor->id])}}">
                    <td>{{strtoupper($contractor->contractor_name)}}</td>
                    <td>{{ucwords($contractor->contact_name)}}</td>
                    <td>{{$contractor->contact_email}}</td>
                    <td>{{$contractor->contact_phone_number}}</td>
                    <td class="d-none d-md-table-cell">{{$contractor->general_liability_insurance_date->format('m/d/Y')}}</td>
                    <td class="d-none d-md-table-cell">{{$contractor->work_comp_employment_insurance_date->format('m/d/Y')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

@endsection