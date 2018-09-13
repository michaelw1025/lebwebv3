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
                Query: Employee Birthday
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
                {{route('export-employee-birthday', ['month' => $month])}}
                @endif
                @endslot

        @endcomponent
                

        @include('alerts.validation-alert')
         @include('alerts.session-alert')

                <!-- Page content goes here -->
        <form action="{{Route('queries.employee-birthday')}}" class="mt-2" id="search-employee-birthday-form" method="GET">
            @csrf
            <h5>Search Birthdays</h5>
            <p class="text-danger">@component('components.required-icon')@endComponent indicates a required field</p>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="employee-birthday-search-month">Month @component('components.required-icon')@endComponent</label>
                    <select name="birthday_month" id="employee-birthday-search-month" class="custom-select {{$errors->has('birthday_month') ? 'is-invalid' : ''}}" required>
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
                    @if($errors->has('birthday_month'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('birthday_month')}}
                        </span>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-success" id="submit-employee-birthday-search">Search</button>
            <button type="button" class="btn btn-info reset-item-search" id="" name="search-employee-birthday-form">Reset</button>
        </form>

        <hr></hr>
        @if(isset($employees))
         <!-- Hire date button -->
         @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-hire-date
                @endslot

                @slot('buttonText')
                Hire Date
                @endslot
        @endcomponent
        <!-- Shift button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-shift
                @endslot

                @slot('buttonText')
                Shift
                @endslot
        @endcomponent
        <!-- Job button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-job
                @endslot

                @slot('buttonText')
                Job
                @endslot
        @endcomponent
        <!-- Position button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-position
                @endslot

                @slot('buttonText')
                Position
                @endslot
        @endcomponent
        <!-- Cost center button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-cost-center
                @endslot

                @slot('buttonText')
                Cost Center
                @endslot
        @endcomponent
        <!-- Team manager button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-team-manager
                @endslot

                @slot('buttonText')
                Team Manager
                @endslot
        @endcomponent
        <!-- Team leader button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-team-leader
                @endslot

                @slot('buttonText')
                Team Leader
                @endslot
        @endcomponent

        
        @include('queries.export-tables.birthday')
        @endif
            
@endsection