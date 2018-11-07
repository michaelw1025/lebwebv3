@extends('layouts.app')

@section('content')

        <!-- Title for content -->
        @component('components.content-title')
            @slot('textClass')
            text-edit
            @endslot

            @slot('fontStyle')
            far
            @endslot

            @slot('fontIcon')
            fa-edit
            @endslot

            @slot('fontSize')
            fa-lg
            @endslot

            @slot('title')
            Edit Bid: {{$bid->posting_number}} {{$bid->position->description}}
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{Route('bids.update', ['id' => $bid->id])}}" class="mt-2" id="edit-bid-form" method="POST" autocomplete="off">
            @csrf
            @method('Patch')
            <a href="{{route('bids.show', ['id' => $bid->id])}}" class="h3 text-primary my-4"><i class="fas fa-arrow-left"></i> Return To Show: {{$bid->posting_number}} {{$bid->position->description}}</a>

            <p class="text-danger mt-4">@component('components.required-icon')@endComponent indicates a field</p>

            <div class="form-row mt-4">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-bid-posting-number">Posting Number @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('posting_number') ? 'is-invalid' : ''}}" id="edit-bid-posting-number" name="posting_number" value="{{old('posting_number') ? old('posting_number') : $bid->posting_number}}">
                    @if($errors->has('posting_number'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('posting_number')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-bid-is-active">Status</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text enabled-checkbox {{$errors->has('is_active') ? 'is-invalid' : ''}}">
                                <input type="checkbox" id="edit-bid-is-active" name="is_active" {{old('is_active') ? (old('is_active') == 1 ? 'checked' : '') : ($bid->is_active == 1 ? 'checked' : '')}}>
                            </div>
                        </div>
                        <input type="text" class="form-control" value="Check here if this bid is currently active" readonly>
                    </div>
                    @if($errors->has('is_active'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('is_active')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-bid-is-posted">Post Bid</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text enabled-checkbox {{$errors->has('is_posted') ? 'is-invalid' : ''}}">
                                <input type="checkbox" id="edit-bid-is-posted" name="is_posted" {{old('is_posted') ? (old('is_posted') == 1 ? 'checked' : '') : ($bid->is_posted == 1 ? 'checked' : '')}}>
                            </div>
                        </div>
                        <input type="text" class="form-control" value="Check here to post this bid" readonly>
                    </div>
                    @if($errors->has('is_posted'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('is_posted')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-bid-post-date">Post Date @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control datepicker {{$errors->has('post_date') ? 'is-invalid' : ''}}" id="edit-bid-post-date" name="post_date" value="{{old('post_date') ? old('post_date') : $bid->post_date->format('m/d/Y')}}">
                    @if($errors->has('post_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('post_date')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-bid-pull-date">Pull Date @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control datepicker {{$errors->has('pull_date') ? 'is-invalid' : ''}}" id="edit-bid-pull-date" name="pull_date" value="{{old('pull_date') ? old('pull_date') : $bid->pull_date->format('m/d/Y')}}">
                    @if($errors->has('pull_date'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('pull_date')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-bid-number-of-openings">Number Of Openings @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('number_of_openings') ? 'is-invalid' : ''}}" id="edit-bid-number-of-openings" name="number_of_openings" value="{{old('number_of_openings') ? old('number_of_openings') : $bid->number_of_openings}}">
                    @if($errors->has('number_of_openings'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('number_of_openings')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-bid-team">Team @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('team_id') ? 'is-invalid' : ''}}" id="edit-bid-team" name="team_id">
                        <option value=""></option>
                        @foreach($teams as $team)
                        <option {{old('team_id') ? (old('team_id') == $team->id ? 'selected' : '') : ($bid->team_id == $team->id ? 'selected' : '')}} value="{{$team->id}}">{{$team->description}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('team_id'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('team_id')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-bid-shift">Shift @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('shift_id') ? 'is-invalid' : ''}}" id="edit-bid-shift" name="shift_id">
                        <option value=""></option>
                        @foreach($shifts as $shift)
                        <option {{old('shift_id') ? (old('shift_id') == $shift->id ? 'selected' : '') : ($bid->shift_id == $shift->id ? 'selected' : '')}} value="{{$shift->id}}">{{$shift->description}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('shift_id'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('shift_id')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-bid-position">Position @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('position_id') ? 'is-invalid' : ''}}" id="edit-bid-position" name="position_id">
                        <option value=""></option>
                        @foreach($positions as $position)
                        <option {{old('position_id') ? (old('position_id') == $position->id ? 'selected' : '') : ($bid->position_id == $position->id ? 'selected' : '')}} value="{{$position->id}}">{{$position->description}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('position_id'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('position_id')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-bid-bid-top-wage">Top Wage @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('bid_top_wage_id') ? 'is-invalid' : ''}}" id="edit-bid-bid-top-wage" name="bid_top_wage_id">
                        <option value=""></option>
                        @foreach($wageTitles as $wageTitle)
                        @foreach($wageTitle->wageProgression as $wageTitleWageProgression)
                        <option {{old('bid_top_wage_id') ? (old('bid_top_wage_id') == $wageTitleWageProgression->pivot->id ? 'selected' : '') : ($bid->bid_top_wage_id == $wageTitleWageProgression->pivot->id ? 'selected' : '')}} value="{{$wageTitleWageProgression->pivot->id}}">{{ucwords($wageTitle->description)}} - ({{$wageTitleWageProgression->month}}) - {{$wageTitleWageProgression->pivot->amount}}</option>
                        @endforeach
                        @endforeach
                    </select>
                    @if($errors->has('bid_top_wage_id'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('bid_top_wage_id')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-bid-bid-education-top-wage">Top Wage With Education @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('bid_education_top_wage_id') ? 'is-invalid' : ''}}" id="edit-bid-bid-education-top-wage" name="bid_education_top_wage_id">
                        <option value=""></option>
                        @foreach($wageTitles as $wageTitle)
                        @foreach($wageTitle->wageProgression as $wageTitleWageProgression)
                        <option {{old('bid_education_top_wage_id') ? (old('bid_education_top_wage_id') == $wageTitleWageProgression->pivot->id ? 'selected' : '') : ($bid->bid_education_top_wage_id == $wageTitleWageProgression->pivot->id ? 'selected' : '')}} value="{{$wageTitleWageProgression->pivot->id}}">{{ucwords($wageTitle->description)}} - ({{$wageTitleWageProgression->month}}) - {{$wageTitleWageProgression->pivot->amount}}</option>
                        @endforeach
                        @endforeach
                    </select>
                    @if($errors->has('bid_education_top_wage_id'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('bid_education_top_wage_id')}}
                        </span>
                    @endif
                </div>

                <!-- <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-bid-is-active">Status</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text enabled-checkbox {{$errors->has('is_active') ? 'is-invalid' : ''}}">
                                <input type="checkbox" id="edit-bid-is-active" name="is_active" {{old('is_active') ? (old('is_active') == 1 ? 'checked' : '') : ($bid->is_active == 1 ? 'checked' : '')}}>
                            </div>
                        </div>
                        <input type="text" class="form-control" value="Is this bid currently active" readonly>
                    </div>
                    @if($errors->has('is_active'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('is_active')}}
                        </span>
                    @endif
                </div> -->

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-bid-education-requirement">Education Requirement</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text enabled-checkbox {{$errors->has('education_requirement') ? 'is-invalid' : ''}}">
                                <input type="checkbox" id="edit-bid-education-requirement" name="education_requirement" {{old('education_requirement') ? (old('education_requirement') == 1 ? 'checked' : '') : ($bid->education_requirement == 1 ? 'checked' : '')}}>
                            </div>
                        </div>
                        <input type="text" class="form-control" value="Check here if top pay is limited by education" readonly>
                    </div>
                    @if($errors->has('education_requirement'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('education_requirement')}}
                        </span>
                    @endif
                </div>

                <!-- <div class="form-group col-md-6 col-lg-4 d-flex">
                    <div class="custom-control custom-checkbox my-auto">
                        <input type="checkbox" class="custom-control-input {{$errors->has('education_requirement') ? 'is-invalid' : ''}}" id="edit-bid-education-requirement" name="education_requirement" {{old('education_requirement') ? 'checked' : ($bid->education_requirement == 1 ? 'checked' : '')}}>
                        <label for="edit-bid-education-requirement" class="custom-control-label">Check here if top pay is limited by education</label>
                    </div>
                    @if($errors->has('education_requirement'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('education_requirement')}}
                        </span>
                    @endif
                </div> -->

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-bid-resume-required">Resume Requirement</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text enabled-checkbox {{$errors->has('resume_required') ? 'is-invalid' : ''}}">
                                <input type="checkbox" id="edit-bid-resume-required" name="resume_required" {{ old('resume_required') ? (old('resume_required') == 1 ? 'checked' : '') : ($bid->resume_required == 1 ? 'checked' : '')}}>
                            </div>
                        </div>
                        <input type="text" class="form-control" value="Check here if a resume is required" readonly>
                    </div>
                    @if($errors->has('resume_required'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('resume_required')}}
                        </span>
                    @endif
                </div>

                <!-- <div class="form-group col-md-6 col-lg-4 d-flex">
                    <div class="custom-control custom-checkbox my-auto">
                        <input type="checkbox" class="custom-control-input {{$errors->has('resume_required') ? 'is-invalid' : ''}}" id="edit-bid-resume-required" name="resume_required" {{old('resume_required') ? 'checked' : ($bid->resume_required == 1 ? 'checked' : '')}}>
                        <label for="edit-bid-resume-required" class="custom-control-label">Check here if a resume is required</label>
                    </div>
                    @if($errors->has('resume_required'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('resume_required')}}
                        </span>
                    @endif
                </div> -->

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-bid-tech-form-required">Tech Form Requirement</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text enabled-checkbox {{$errors->has('tech_form_required') ? 'is-invalid' : ''}}">
                                <input type="checkbox" id="edit-bid-tech-form-required" name="tech_form_required" {{old('tech_form_required') ? (old('tech_form_required') == 1 ? 'checked' : '') : ($bid->tech_form_required == 1 ? 'checked' : '')}}>
                            </div>
                        </div>
                        <input type="text" class="form-control" value="Is a tech form required" readonly>
                    </div>
                    @if($errors->has('tech_form_required'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('tech_form_required')}}
                        </span>
                    @endif
                </div>

                <!-- <div class="form-group col-md-6 col-lg-4 d-flex">
                    <div class="custom-control custom-checkbox my-auto">
                        <input type="checkbox" class="custom-control-input {{$errors->has('tech_form_required') ? 'is-invalid' : ''}}" id="edit-bid-tech-form-required" name="tech_form_required" {{old('tech_form_required') ? 'checked' : ($bid->tech_form_required == 1 ? 'checked' : '')}}>
                        <label for="edit-bid-tech-form-required" class="custom-control-label">Check here if a tech form is required</label>
                    </div>
                    @if($errors->has('tech_form_required'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('tech_form_required')}}
                        </span>
                    @endif
                </div> -->

                <div class="form-group col-12">
                    <label for="edit-bid-summary">Summary @component('components.required-icon')@endComponent</label>
                    <textarea class="form-control {{$errors->has('summary') ? 'is-invalid' : ''}}" id="edit-bid-summary" rows="3" name="summary">{{old('summary') ? old('summary') : $bid->summary}}</textarea>
                    @if($errors->has('summary'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('summary')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-12">
                    <label for="edit-bid-essential-duties-responsibilities">Essential Duties And Responsibilities @component('components.required-icon')@endComponent</label>
                    <textarea class="form-control {{$errors->has('essential_duties_responsibilities') ? 'is-invalid' : ''}}" id="edit-bid-essential-duties-responsibilities" rows="3" name="essential_duties_responsibilities">{{old('essential_duties_responsibilities') ? old('essential_duties_responsibilities') : $bid->essential_duties_responsibilities}}</textarea>
                    @if($errors->has('essential_duties_responsibilities'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('essential_duties_responsibilities')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-12">
                    <label for="edit-bid-qualifications">Qualifications @component('components.required-icon')@endComponent</label>
                    <textarea class="form-control {{$errors->has('qualifications') ? 'is-invalid' : ''}}" id="edit-bid-qualifications" rows="3" name="qualifications">{{old('qualifications') ? old('qualifications') : $bid->qualifications}}</textarea>
                    @if($errors->has('qualifications'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('qualifications')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-12">
                    <label for="edit-bid-successful-bidder">Successful Bidder Must Be Able To @component('components.required-icon')@endComponent</label>
                    <textarea class="form-control {{$errors->has('successful_bidder') ? 'is-invalid' : ''}}" id="edit-bid-successful-bidder" rows="3" name="successful_bidder">{{old('successful_bidder') ? old('successful_bidder') : $bid->successful_bidder}}</textarea>
                    @if($errors->has('successful_bidder'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('successful_bidder')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-12">
                    <label for="edit-bid-education-experience">Education And/Or Experience @component('components.required-icon')@endComponent</label>
                    <textarea class="form-control {{$errors->has('education_experience') ? 'is-invalid' : ''}}" id="edit-bid-education-experience" rows="3" name="education_experience">{{old('education_experience') ? old('education_experience') : $bid->education_experience}}</textarea>
                    @if($errors->has('education_experience'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('education_experience')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-12">
                    <label for="edit-bid-physical-demand">Physical Demands @component('components.required-icon')@endComponent</label>
                    <textarea class="form-control {{$errors->has('physical_demands') ? 'is-invalid' : ''}}" id="edit-bid-physical-demand" rows="3" name="physical_demands">{{old('physical_demands') ? old('physical_demands') : $bid->physical_demands}}</textarea>
                    @if($errors->has('physical_demands'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('physical_demands')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-12">
                    <label for="edit-bid-math-skills">Math Skills</label>
                    <textarea class="form-control {{$errors->has('math_skills') ? 'is-invalid' : ''}}" id="edit-bid-math-skills" rows="3" name="math_skills">{{old('math_skills') ? old('math_skills') : $bid->math_skills}}</textarea>
                    @if($errors->has('math_skills'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('math_skills')}}
                        </span>
                    @endif
                </div>

            </div>

            <button type="submit" class="btn btn-success" id="edit-bid-submit-button">Save Bid</button>
        </form>
        @if(Auth::user()->hasAnyRole(['admin']))
        <form action="{{Route('bids.destroy', [$bid->id])}}" class="mt-2" id="delete-bid-form" method="POST">
            @csrf
            @method('Delete')
            <button type="submit" class="btn btn-outline-danger delete-item" id="delete-bid-submit-button" name="bid">Delete Bid</button>
        </form>
        @endif

        <hr></hr>
        <hr></hr>

@endsection