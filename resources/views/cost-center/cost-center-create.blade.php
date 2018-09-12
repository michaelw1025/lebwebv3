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
            Create: Cost Center
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{Route('costCenters.store')}}" class="mt-2" id="create-cost-center-form" method="POST" autocomplete="off">
            @csrf

            <p class="text-danger mt-4">@component('components.required-icon')@endComponent indicates a required field</p>

            <div class="form-row mt-4">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-cost-center-number">Number @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('number') ? 'is-invalid' : ''}}" id="create-cost-center-number" name="number" value="{{old('number')}}" required>
                    @if($errors->has('number'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('number')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-cost-center-extension">Extension</label>
                    <select class="custom-select {{$errors->has('extension') ? 'is-invalid' : ''}}" id="create-cost-center-extension" name="extension">
                        <option value=""></option>
                        <option {{old('extension') ? (old('extension') == 'a' ? 'selected' : '') : ''}} value="a">a</option>
                        <option {{old('extension') ? (old('extension') == 'b' ? 'selected' : '') : ''}} value="b">b</option>
                        <option {{old('extension') ? (old('extension') == 'c' ? 'selected' : '') : ''}} value="c">c</option>
                        <option {{old('extension') ? (old('extension') == 'd' ? 'selected' : '') : ''}} value="d">d</option>
                        <option {{old('extension') ? (old('extension') == 'e' ? 'selected' : '') : ''}} value="e">e</option>
                        <option {{old('extension') ? (old('extension') == 'f' ? 'selected' : '') : ''}} value="f">f</option>
                        <option {{old('extension') ? (old('extension') == 'g' ? 'selected' : '') : ''}} value="g">g</option>
                        <option {{old('extension') ? (old('extension') == 'h' ? 'selected' : '') : ''}} value="h">h</option>
                        <option {{old('extension') ? (old('extension') == 'i' ? 'selected' : '') : ''}} value="i">i</option>
                        <option {{old('extension') ? (old('extension') == 'j' ? 'selected' : '') : ''}} value="j">j</option>
                    </select>
                    @if($errors->has('extension'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('extension')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-cost-center-description">Description @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" id="create-cost-center-description" name="description" value="{{old('description')}}" required>
                    @if($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('description')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-cost-center-staff-manager">Staff Manager @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('staff_manager') ? 'is-invalid' : ''}}" id="create-cost-center-staff-manager" name="staff_manager" required>
                    <option value=""></option>
                    @foreach($supervisors as $supervisor)
                    <option {{old('staff_manager') ? (old('staff_manager') == $supervisor->id ? 'selected' : '') : ''}} value="{{$supervisor->id}}">{{$supervisor->first_name}} {{$supervisor->last_name}}</option>
                    @endforeach
                    </select>
                    @if($errors->has('staff_manager'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('staff_manager')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-cost-center-day-team-manager">Day Team Manager @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('day_team_manager') ? 'is-invalid' : ''}}" id="create-cost-center-day-team-manager" name="day_team_manager" required>
                    <option value=""></option>
                    @foreach($supervisors as $supervisor)
                    <option {{old('day_team_manager') ? (old('day_team_manager') == $supervisor->id ? 'selected' : '') : ''}} value="{{$supervisor->id}}">{{$supervisor->first_name}} {{$supervisor->last_name}}</option>
                    @endforeach
                    </select>
                    @if($errors->has('day_team_manager'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('day_team_manager')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-cost-center-night-team-manager">Night Team Manager @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('night_team_manager') ? 'is-invalid' : ''}}" id="create-cost-center-night-team-manager" name="night_team_manager" required>
                    <option value=""></option>
                    @foreach($supervisors as $supervisor)
                    <option {{old('night_team_manager') ? (old('night_team_manager') == $supervisor->id ? 'selected' : '') : ''}} value="{{$supervisor->id}}">{{$supervisor->first_name}} {{$supervisor->last_name}}</option>
                    @endforeach
                    </select>
                    @if($errors->has('night_team_manager'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('night_team_manager')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-cost-center-day-team-leader">Day Team Leader @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('day_team_leader') ? 'is-invalid' : ''}}" id="create-cost-center-day-team-leader" name="day_team_leader" required>
                    <option value=""></option>
                    @foreach($supervisors as $supervisor)
                    <option {{old('day_team_leader') ? (old('day_team_leader') == $supervisor->id ? 'selected' : '') : ''}} value="{{$supervisor->id}}">{{$supervisor->first_name}} {{$supervisor->last_name}}</option>
                    @endforeach
                    </select>
                    @if($errors->has('day_team_leader'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('day_team_leader')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-cost-center-night-team-leader">Night Team Leader @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('night_team_leader') ? 'is-invalid' : ''}}" id="create-cost-center-night-team-leader" name="night_team_leader" required>
                    <option value=""></option>
                    @foreach($supervisors as $supervisor)
                    <option {{old('night_team_leader') ? (old('night_team_leader') == $supervisor->id ? 'selected' : '') : ''}} value="{{$supervisor->id}}">{{$supervisor->first_name}} {{$supervisor->last_name}}</option>
                    @endforeach
                    </select>
                    @if($errors->has('night_team_leader'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('night_team_leader')}}
                        </span>
                    @endif
                </div>

            </div>

            <button type="submit" class="btn btn-success" id="create-cost-center-submit-button">Create Cost Center</button>
        </form>


@endsection