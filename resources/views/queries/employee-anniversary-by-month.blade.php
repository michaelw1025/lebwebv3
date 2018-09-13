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
                Query: Employee Anniversary By Month
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
                {{route('export-employee-anniversary-by-month', ['month' => $month, 'year' => $year])}}
                @endif
                @endslot

        @endcomponent
                

                @include('alerts.validation-alert')
                @include('alerts.session-alert')

                <!-- Page content goes here -->
        <form action="{{Route('queries.employee-anniversary-by-month')}}" class="mt-2" id="search-employee-anniversary-by-month-form" method="GET">
            @csrf
            <h5>Search Anniversaries</h5>
            <p class="text-danger">@component('components.required-icon')@endComponent indicates a required field</p>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="employee-anniversary-search-month">Month @component('components.required-icon')@endComponent</label>
                    <select name="anniversary_month" id="" class="custom-select {{$errors->has('anniversary_month') ? 'is-invalid' : ''}}" required>
                        <option value=""></option>
                        <option {{isset($month) ? ($month == 1 ? 'selected' : '') : ''}} value="1">1 - January</option>
                        <option {{isset($month) ? ($month == 2 ? 'selected' : '') : ''}} value="2">2 - February</option>
                        <option {{isset($month) ? ($month == 3 ? 'selected' : '') : ''}} value="3">3 - March</option>
                        <option {{isset($month) ? ($month == 4 ? 'selected' : '') : ''}} value="4">4 - April</option>
                        <option {{isset($month) ? ($month == 5 ? 'selected' : '') : ''}} value="5">5 - May</option>
                        <option {{isset($month) ? ($month == 6 ? 'selected' : '') : ''}} value="6">6 - June</option>
                        <option {{isset($month) ? ($month == 7 ? 'selected' : '') : ''}} value="7">7 - July</option>
                        <option {{isset($month) ? ($month == 8 ? 'selected' : '') : ''}} value="8">8 - August</option>
                        <option {{isset($month) ? ($month == 9 ? 'selected' : '') : ''}} value="9">9 - September</option>
                        <option {{isset($month) ? ($month == 10 ? 'selected' : '') : ''}} value="10">10 - October</option>
                        <option {{isset($month) ? ($month == 11 ? 'selected' : '') : ''}} value="11">11 - November</option>
                        <option {{isset($month) ? ($month == 12 ? 'selected' : '') : ''}} value="12">12 - December</option>
                    </select>
                    @if($errors->has('anniversary_month'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('anniversary_month')}}
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