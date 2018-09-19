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
            Create: Bid
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{Route('bidding.store')}}" class="mt-2" id="create-bid-form" method="POST" autocomplete="off">
            @csrf

            <p class="text-danger mt-4">@component('components.required-icon')@endComponent indicates a required field</p>

            <div class="form-row mt-4">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-bid-post-date">Post Date @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control datepicker {{$errors->has('post_date') ? 'is-invalid' : ''}}" id="create-bid-post-date" name="post_date" value="{{old('post_date')}}" required>
                    @if($errors->has('post_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('post_date')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-bid-pull-date">Pull Date @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control datepicker {{$errors->has('pull_date') ? 'is-invalid' : ''}}" id="create-bid-pull-date" name="pull_date" value="{{old('pull_date')}}" required>
                    @if($errors->has('pull_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('pull_date')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-bid-posting-number">Posting Number @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('posting_number') ? 'is-invalid' : ''}}" id="create-bid-posting-number" name="posting_number" value="{{old('posting_number')}}" required>
                    @if($errors->has('posting_number'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('posting_number')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-bid-number-of-openings">Number Of Openings @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('number_of_openings') ? 'is-invalid' : ''}}" id="create-bid-number-of-openings" name="number_of_openings" value="{{old('number_of_openings')}}" required>
                    @if($errors->has('number_of_openings'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('number_of_openings')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-bid-team">Team @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('team') ? 'is-invalid' : ''}}" id="create-bid-team" name="team" required>
                        <option value=""></option>
                        @foreach($teams as $team)
                        <option {{old('team') ? (old('team') == $team->id ? 'selected' : '') : ''}} value="{{$team->id}}">{{$team->description}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('team'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('team')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-bid-shift">Shift @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('shift') ? 'is-invalid' : ''}}" id="create-bid-shift" name="shift" required>
                        <option value=""></option>
                        @foreach($shifts as $shift)
                        <option {{old('shift') ? (old('shift') == $shift->id ? 'selected' : '') : ''}} value="{{$shift->id}}">{{$shift->description}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('shift'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('shift')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-bid-position">Position @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('position') ? 'is-invalid' : ''}}" id="create-bid-position" name="position" required>
                        <option value=""></option>
                        @foreach($positions as $position)
                        <option {{old('position') ? (old('position') == $position->id ? 'selected' : '') : ''}} value="{{$position->id}}">{{$position->description}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('position'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('position')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-bid-top-wage">Top Wage @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('top_wage') ? 'is-invalid' : ''}}" id="create-bid-top-wage" name="top_wage" required>
                        <option value=""></option>
                        @foreach($wageTitles as $wageTitle)
                        @foreach($wageTitle->wageProgression as $wageTitleWageProgression)
                        <option {{old('top_wage') ? (old('top_wage') == $wageTitleWageProgression->pivot->id ? 'selected' : '') : ''}} value="{{$wageTitleWageProgression->pivot->id}}">{{ucwords($wageTitle->description)}} - ({{$wageTitleWageProgression->month}}) - {{$wageTitleWageProgression->pivot->amount}}</option>
                        @endforeach
                        @endforeach
                    </select>
                    @if($errors->has('top_wage'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('top_wage')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-bid-top-wage-with-education">Top Wage With Education @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('top_wage_with_education') ? 'is-invalid' : ''}}" id="create-bid-top-wage-with-education" name="top_wage_with_education" required>
                        <option value=""></option>
                        @foreach($wageTitles as $wageTitle)
                        @foreach($wageTitle->wageProgression as $wageTitleWageProgression)
                        <option {{old('top_wage_with_education') ? (old('top_wage_with_education') == $wageTitleWageProgression->pivot->id ? 'selected' : '') : ''}} value="{{$wageTitleWageProgression->pivot->id}}">{{ucwords($wageTitle->description)}} - ({{$wageTitleWageProgression->month}}) - {{$wageTitleWageProgression->pivot->amount}}</option>
                        @endforeach
                        @endforeach
                    </select>
                    @if($errors->has('top_wage_with_education'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('top_wage_with_education')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4 d-flex">
                    <div class="custom-control custom-checkbox my-auto">
                        <input type="checkbox" class="custom-control-input" id="create-bid-education-requirement" name="education_requirement" {{old(education_requirement) ? 'checked' : ''}}>
                        <label for="create-bid-education-requirement" class="custom-control-label">Is Top Pay Limited By Education</label>
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-success" id="create-bid-submit-button">Create Bid</button>
        </form>


@endsection