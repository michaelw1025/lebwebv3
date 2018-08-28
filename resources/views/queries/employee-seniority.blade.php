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
                sa-search
                @endslot

                @slot('fontSize')
                fa-lg
                @endslot

                @slot('title')
                Query: Employees Seniority
                @endslot

                @slot('displayExport')
                d-block
                @endslot

                @slot('exportRoute')
            
                @endslot
        @endcomponent
                

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <!-- SSN button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-ssn
                @endslot

                @slot('buttonText')
                SSN
                @endslot
        @endcomponent
        <!-- Birth Date button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-birth-date
                @endslot

                @slot('buttonText')
                Birth Date
                @endslot
        @endcomponent
        <!-- Service Date button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-service-date
                @endslot

                @slot('buttonText')
                Service Date
                @endslot
        @endcomponent
        <!-- Address button -->
        @component('components.table-column-toggle')
                 @slot('buttonID')
                toggle-address
                @endslot

                @slot('buttonText')
                Address
                @endslot
        @endcomponent
        <!-- Bid Eligible button -->
        @component('components.table-column-toggle')
                 @slot('buttonID')
                toggle-bid-eligible
                @endslot

                @slot('buttonText')
                Bid Eligible
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
        <!-- Position button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-position
                @endslot

                @slot('buttonText')
                Position
                @endslot
        @endcomponent
        <!-- Cost Center button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-cost-center
                @endslot

                @slot('buttonText')
                Cost Center
                @endslot
        @endcomponent
        <!-- Team Manager button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-team-manager
                @endslot

                @slot('buttonText')
                Team Manager
                @endslot
        @endcomponent
        <!-- Team Leader button -->
        @component('components.table-column-toggle')
                @slot('buttonID')
                toggle-team-leader
                @endslot

                @slot('buttonText')
                Team Leader
                @endslot
        @endcomponent
        
                <!-- Page content goes here -->
        <table class="table table-sm table-hover table-striped table-borderless">
            <thead class="bg-header text-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col" class="">Hire Date</th>
                    <th scope="col" class="d-none toggle-ssn">SSN</th>
                    <th scope="col" class="d-none toggle-birth-date">Birth Date</th>
                    <th scope="col" class="d-none toggle-service-date">Service Date</th>
                    <th scope="col" class="d-none toggle-address">Address</th>
                    <th scope="col" class="d-none toggle-bid-eligible">Bid Eligible</th>
                    <th scope="col" class="d-none toggle-shift">Shift</th>
                    <th scope="col" class="d-none toggle-position">Position</th>
                    <th scope="col" class="d-none toggle-cost-center">Cost Center</th>
                    <th scope="col" class="d-none toggle-team-manager">Team Manager</th>
                    <th scope="col" class="d-none toggle-team-leader">Team Leader</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                <tr class="clickable-row employee-row" data-href="{{route('employees.show', ['id' => $employee->id])}}">
                    <td>{{$employee->id}}</td>
                    <td>{{$employee->first_name}}</td>
                    <td>{{$employee->last_name}}</td>
                    <td class="">{{$employee->hire_date->format('m/d/Y')}}</td>
                    <td class="d-none toggle-ssn">{{$employee->ssn}}</td>
                    <td class="d-none toggle-birth-date">{{$employee->birth_date->format('m/d/Y')}}</td>
                    <td class="d-none toggle-service-date">{{$employee->service_date->format('m/d/Y')}}</td>
                    <td class="d-none toggle-address">{{$employee->address_1}} {{$employee->address_2}}, {{$employee->city}}, {{$employee->state}}, {{$employee->zip_code}}</td>
                    <td class="d-none toggle-bid-eligible"><i class="{{$employee->bid_eligible == 1 ? 'far fa-thumbs-up text-success' : 'far fa-thumbs-down text-danger'}}"></i></td>
                    @if($employee->shift->count() > 0)
                        @foreach($employee->shift as $shift)
                        <td class="d-none toggle-shift">{{$shift->description}}</td>
                        @endforeach
                    @else
                        <td class="d-none toggle-shift text-danger">Not Set</td>
                    @endif
                    @if($employee->position->count() > 0)
                        @foreach($employee->position as $position)
                        <td class="d-none toggle-position">{{$position->description}}</td>
                        @endforeach
                    @else
                        <td class="d-none toggle-position text-danger">Not Set</td>
                    @endif
                    @if($employee->costCenter->count() > 0)
                        @foreach($employee->costCenter as $costCenter)
                        <td class="d-none toggle-cost-center">{{$costCenter->number}} {{$costCenter->extension != null ? ' - '.$costCenter->extension : ''}}</td>
                        @endforeach
                    @else
                    <td class="d-none toggle-cost-center text-danger">Not Set</td>
                    @endif
                    <td class="d-none toggle-team-manager">{{$employee->team_manager}}</td>
                    <td class="d-none toggle-team-leader">{{$employee->team_leader}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
            
@endsection