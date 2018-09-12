@extends('layouts.app')

@section('content')

                <!-- Title for content -->
        @component('components.content-title')
                @slot('textClass')
                text-primary
                @endslot

                @slot('fontStyle')
                        
                @endslot

                @slot('fontIcon')
                        
                @endslot

                @slot('fontSize')
                        
                @endslot
                
                @slot('title')
                Query: Employee Turnover - Hourly
                @endslot

                @slot('displayExport')
                @if(isset($employees))
                d-block
                @else
                d-none
                @endif
                @endslot

                @slot('exportRoute')
                @if(isset($employees))
                {{Route('export-employee-turnover-hourly', ['start_date' => $startDate->format('m/d/Y'), 'end_date' => $endDate->format('m/d/Y')])}}
                @endif
                @endslot
        @endcomponent
                

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <!-- Page content goes here -->
        <form action="{{Route('queries.employee-turnover-hourly')}}" class="mt-2" id="search-employee-turnover-hourly-form" method="GET" autocomplete="off">
            @csrf
            <h5>Search Turnover</h5>
            <p class="text-danger">@component('components.required-icon')@endComponent indicates a required field</p>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="employee-search-turnover-start-date">Start Date @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('start_date') ? 'is-invalid' : ''}} datepicker" id="employee-search-turnover-start-date" name="start_date" value="{{old('start_date') ? old('start_date') : (isset($startDate) ? $startDate->format('m/d/Y') :'')}}" required>
                    @if($errors->has('start_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('start_date')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="employee-search-turnover-end-date">End Date @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('end_date') ? 'is-invalid' : ''}} datepicker" id="employee-search-turnover-end-date" name="end_date" value="{{old('end_date') ? old('end_date') : (isset($endDate) ? $endDate->format('m/d/Y') :'')}}" required>
                    @if($errors->has('end_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('end_date')}}
                        </span>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-success" id="submit-employee-turnover-search">Search</button>
            <button type="button" class="btn btn-info reset-item-search" id="" name="search-employee-turnover-form">Reset</button>
        </form>

        <hr></hr>

        @if(isset($employees))
        @include('queries.export-tables.turnover')
        @endif
            
@endsection