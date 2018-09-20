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

            <p class="text-danger mt-4">@component('components.required-icon')@endComponent indicates a field</p>

            <div class="form-row mt-4">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-bid-post-date">Post Date @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control datepicker {{$errors->has('post_date') ? 'is-invalid' : ''}}" id="create-bid-post-date" name="post_date" value="{{old('post_date')}}">
                    @if($errors->has('post_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('post_date')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-bid-pull-date">Pull Date @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control datepicker {{$errors->has('pull_date') ? 'is-invalid' : ''}}" id="create-bid-pull-date" name="pull_date" value="{{old('pull_date')}}">
                    @if($errors->has('pull_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('pull_date')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-bid-posting-number">Posting Number @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('posting_number') ? 'is-invalid' : ''}}" id="create-bid-posting-number" name="posting_number" value="{{old('posting_number')}}">
                    @if($errors->has('posting_number'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('posting_number')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-bid-number-of-openings">Number Of Openings @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('number_of_openings') ? 'is-invalid' : ''}}" id="create-bid-number-of-openings" name="number_of_openings" value="{{old('number_of_openings')}}">
                    @if($errors->has('number_of_openings'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('number_of_openings')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-bid-team">Team @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('team_id') ? 'is-invalid' : ''}}" id="create-bid-team" name="team_id">
                        <option value=""></option>
                        @foreach($teams as $team)
                        <option {{old('team_id') ? (old('team_id') == $team->id ? 'selected' : '') : ''}} value="{{$team->id}}">{{$team->description}}</option>
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
                    <select class="custom-select {{$errors->has('shift_id') ? 'is-invalid' : ''}}" id="create-bid-shift" name="shift_id">
                        <option value=""></option>
                        @foreach($shifts as $shift)
                        <option {{old('shift_id') ? (old('shift_id') == $shift->id ? 'selected' : '') : ''}} value="{{$shift->id}}">{{$shift->description}}</option>
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
                    <select class="custom-select {{$errors->has('position_id') ? 'is-invalid' : ''}}" id="create-bid-position" name="position_id">
                        <option value=""></option>
                        @foreach($positions as $position)
                        <option {{old('position_id') ? (old('position_id') == $position->id ? 'selected' : '') : ''}} value="{{$position->id}}">{{$position->description}}</option>
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
                    <select class="custom-select {{$errors->has('top_wage_id') ? 'is-invalid' : ''}}" id="create-bid-top-wage" name="top_wage_id">
                        <option value=""></option>
                        @foreach($wageTitles as $wageTitle)
                        @foreach($wageTitle->wageProgression as $wageTitleWageProgression)
                        <option {{old('top_wage_id') ? (old('top_wage_id') == $wageTitleWageProgression->pivot->id ? 'selected' : '') : ''}} value="{{$wageTitleWageProgression->pivot->id}}">{{ucwords($wageTitle->description)}} - ({{$wageTitleWageProgression->month}}) - {{$wageTitleWageProgression->pivot->amount}}</option>
                        @endforeach
                        @endforeach
                    </select>
                    @if($errors->has('top_wage_id'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('top_wage_id')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-bid-top-wage-with-education">Top Wage With Education @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('top_wage_with_education_id') ? 'is-invalid' : ''}}" id="create-bid-top-wage-with-education" name="top_wage_with_education_id">
                        <option value=""></option>
                        @foreach($wageTitles as $wageTitle)
                        @foreach($wageTitle->wageProgression as $wageTitleWageProgression)
                        <option {{old('top_wage_with_education_id') ? (old('top_wage_with_education_id') == $wageTitleWageProgression->pivot->id ? 'selected' : '') : ''}} value="{{$wageTitleWageProgression->pivot->id}}">{{ucwords($wageTitle->description)}} - ({{$wageTitleWageProgression->month}}) - {{$wageTitleWageProgression->pivot->amount}}</option>
                        @endforeach
                        @endforeach
                    </select>
                    @if($errors->has('top_wage_with_education_id'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('top_wage_with_education_id')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4 d-flex">
                    <div class="custom-control custom-checkbox my-auto">
                        <input type="checkbox" class="custom-control-input {{$errors->has('education_requirement') ? 'is-invalid' : ''}}" id="create-bid-education-requirement" name="education_requirement" {{old('education_requirement') ? 'checked' : ''}}>
                        <label for="create-bid-education-requirement" class="custom-control-label">Check here if top pay is limited by education</label>
                    </div>
                    @if($errors->has('education_requirement'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('education_requirement')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4 d-flex">
                    <div class="custom-control custom-checkbox my-auto">
                        <input type="checkbox" class="custom-control-input {{$errors->has('resume_required') ? 'is-invalid' : ''}}" id="create-bid-resume-required" name="resume_required" {{old('resume_required') ? 'checked' : ''}}>
                        <label for="create-bid-resume-required" class="custom-control-label">Check here if a resume is</label>
                    </div>
                    @if($errors->has('resume_required'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('resume_required')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4 d-flex">
                    <div class="custom-control custom-checkbox my-auto">
                        <input type="checkbox" class="custom-control-input {{$errors->has('tech_form_required') ? 'is-invalid' : ''}}" id="create-bid-tech-form-required" name="tech_form_required" {{old('tech_form_required') ? 'checked' : ''}}>
                        <label for="create-bid-tech-form-required" class="custom-control-label">Check here if a tech form is</label>
                    </div>
                    @if($errors->has('tech_form_required'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('tech_form_required')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-12">
                    <label for="create-bid-summary">Summary @component('components.required-icon')@endComponent</label>
                    <textarea class="form-control {{$errors->has('summary') ? 'is-invalid' : ''}}" id="create-bid-summary" rows="3" name="summary">{{old('summary')}}</textarea>
                    @if($errors->has('summary'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('summary')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-12">
                    <label for="create-bid-essential-duties-responsibilities">Essential Duties And Responsibilities @component('components.required-icon')@endComponent</label>
                    <textarea class="form-control {{$errors->has('essential_duties_responsibilities') ? 'is-invalid' : ''}}" id="create-bid-essential-duties-responsibilities" rows="3" name="essential_duties_responsibilities">{{old('essential_duties_responsibilities')}}</textarea>
                    @if($errors->has('essential_duties_responsibilities'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('essential_duties_responsibilities')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-12">
                    <label for="create-bid-qualifications">Qualifications @component('components.required-icon')@endComponent</label>
                    <textarea class="form-control {{$errors->has('qualifications') ? 'is-invalid' : ''}}" id="create-bid-qualifications" rows="3" name="qualifications">{{old('qualifications')}}</textarea>
                    @if($errors->has('qualifications'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('qualifications')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-12">
                    <label for="create-bid-successful-bidder">Successful Bidder Must Be Able To @component('components.required-icon')@endComponent</label>
                    <textarea class="form-control {{$errors->has('successful_bidder') ? 'is-invalid' : ''}}" id="create-bid-successful-bidder" rows="3" name="successful_bidder">{{old('successful_bidder')}}</textarea>
                    @if($errors->has('successful_bidder'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('successful_bidder')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-12">
                    <label for="create-bid-education-experience">Education And/Or Experience @component('components.required-icon')@endComponent</label>
                    <textarea class="form-control {{$errors->has('education_experience') ? 'is-invalid' : ''}}" id="create-bid-education-experience" rows="3" name="education_experience">{{old('education_experience')}}</textarea>
                    @if($errors->has('education_experience'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('education_experience')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-12">
                    <label for="create-bid-physical-demand">Physical Demands @component('components.required-icon')@endComponent</label>
                    <textarea class="form-control {{$errors->has('physical_demands') ? 'is-invalid' : ''}}" id="create-bid-physical-demand" rows="3" name="physical_demands">{{old('physical_demands')}}</textarea>
                    @if($errors->has('physical_demands'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('physical_demands')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-12">
                    <label for="create-bid-math-skills">Math Skills</label>
                    <textarea class="form-control {{$errors->has('math_skills') ? 'is-invalid' : ''}}" id="create-bid-math-skills" rows="3" name="math_skills">{{old('math_skills')}}</textarea>
                    @if($errors->has('math_skills'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('math_skills')}}
                        </span>
                    @endif
                </div>

            </div>

            <button type="submit" class="btn btn-success" id="create-bid-submit-button">Create Bid</button>
        </form>

        <hr></hr>
        <hr></hr>

@endsection