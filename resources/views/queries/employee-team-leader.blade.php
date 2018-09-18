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
                Query:  Team Leader
                @endslot

                @slot('displayExport')
                @if(isset($searchTeamLeader))
                d-block
                @else
                d-none
                @endif
                @endslot

                @slot('exportRoute')
                @if(isset($searchTeamLeader))
                {{Route('export-employee-team-leader', ['team_leader' => $searchTeamLeader->id, 'shift' => $tlShift])}}
                @endif
                @endslot
        @endcomponent
                

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <!-- Page content goes here -->
        <form action="{{Route('queries.employee-team-leader')}}" class="mt-2" id="search-team-leader-form" method="GET">
            @csrf
            <h5>Search Team Leader</h5>
            <p class="text-danger">@component('components.required-icon')@endComponent indicates a required field</p>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="team-leader-search">Team Leader @component('components.required-icon')@endComponent</label>
                    <select name="team_leader" id="team-leader-search" class="custom-select {{$errors->has('team_leader') ? 'is-invalid' : ''}}" >
                        <option value=""></option>
                        <optgroup label="Day TL">
                        @foreach($dayTeamLeaders as $dayTeamLeader)
                        <option value="1-{{$dayTeamLeader->id}}">{{$dayTeamLeader->first_name}} {{$dayTeamLeader->last_name}}</option>
                        @endforeach
                        </optgroup>
                        <optgroup label="Night TL">
                        @foreach($nightTeamLeaders as $nightTeamLeader)
                        <option value="2-{{$nightTeamLeader->id}}">{{$nightTeamLeader->first_name}} {{$nightTeamLeader->last_name}}</option>
                        @endforeach
                        </optgroup>
                    </select>
                    @if($errors->has('team_leader'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('team_leader')}}
                        </span>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-success" id="submit-team-leader-search">Search</button>
            <button type="button" class="btn btn-info reset-item-search" id="" name="search-team-leader-form">Reset</button>
        </form>

        <hr></hr>
        @if(isset($searchTeamLeader))
        @include('queries.export-tables.team-leader')
        @endif
            
@endsection