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
                Query: Employee Anniversary By Quarter
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
                {{route('export-employee-anniversary-by-quarter', ['quarter' => $quarter, 'year' => $year])}}
                @endif
                @endslot

        @endcomponent
                

                @include('alerts.validation-alert')
                @include('alerts.session-alert')

                <!-- Page content goes here -->
        <form action="{{Route('queries.employee-anniversary-by-quarter')}}" class="mt-2" id="search-employee-anniversary-by-quarter-form" method="GET">
            @csrf
            <h5>Search Anniversaries</h5>
            <p class="text-danger">@component('components.required-icon')@endComponent indicates a required field</p>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="employee-anniversary-search-quarter">Calendar Quarter @component('components.required-icon')@endComponent</label>
                    <select name="anniversary_quarter" id="" class="custom-select {{$errors->has('anniversary_quarter') ? 'is-invalid' : ''}}" required>
                        <option value=""></option>
                        <option {{isset($quarter) ? ($quarter == 1 ? 'selected' : '') : ''}} value="1">Q1</option>
                        <option {{isset($quarter) ? ($quarter == 2 ? 'selected' : '') : ''}} value="2">Q2</option>
                        <option {{isset($quarter) ? ($quarter == 3 ? 'selected' : '') : ''}} value="3">Q3</option>
                        <option {{isset($quarter) ? ($quarter == 4 ? 'selected' : '') : ''}} value="4">Q4</option>
                    </select>
                    @if($errors->has('anniversary_quarter'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('anniversary_quarter')}}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="employee-anniversary-search-year">Year @component('components.required-icon')@endComponent</label>
                    <select name="anniversary_year" id="" class="custom-select {{$errors->has('anniversary_year') ? 'is-invalid' : ''}}" required>
                        <option value=""></option>
                        @for($i = 2015; $i < 2031; $i++)
                        <option {{isset($year) ? ($year == $i ? 'selected' : '') : ''}} value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                    @if($errors->has('anniversary_year'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('anniversary_year')}}
                        </span>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-success" id="submit-employee-anniversary-search">Search</button>
            <button type="button" class="btn btn-info reset-item-search" id="" name="search-employee-anniversary-form">Reset</button>
        </form>

        <hr></hr>

        @if(isset($employees))
        @include('queries.export-tables.anniversary')
        @endif
            
@endsection