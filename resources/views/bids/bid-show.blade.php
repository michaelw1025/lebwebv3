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
            fa-info-circle
            @endslot

            @slot('fontSize')
            fa-lg
            @endslot

            @slot('title')
            Show Bid: {{$bid->posting_number}} {{$bid->position->description}}
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="" class="mt-2" id="show-bid-form" method="GET" autocomplete="off">
            @csrf

            <div class="form-row mt-4">
                @if($bid->is_active == 1)
                    <h1 class="text-success">Bid {{$bid->posting_number}} is active.</h1>
                @else
                    <h1 class="text-danger">Bid {{$bid->posting_number}} is inactive.</h1>
                @endif
            </div>

            <div class="form-row mt-4">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-bid-posting-number">Posting Number</label>
                    <input type="text" class="form-control" id="show-bid-posting-number" name="posting_number" value="{{$bid->posting_number}}" disabled>
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-bid-is-active">Status</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input type="checkbox" id="show-bid-is-active" name="is_active" {{$bid->is_active == 1 ? 'checked' : ''}}>
                            </div>
                        </div>
                        <input type="text" class="form-control" value="Is this bid currently active" disabled>
                    </div>
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-bid-post-date">Post Date</label>
                    <input type="text" class="form-control" id="show-bid-post-date" name="post_date" value="{{$bid->post_date->format('m/d/Y')}}" disabled>
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-bid-pull-date">Pull Date</label>
                    <input type="text" class="form-control" id="show-bid-pull-date" name="pull_date" value="{{$bid->pull_date->format('m/d/Y')}}" disabled>
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-bid-number-of-openings">Number Of Openings</label>
                    <input type="text" class="form-control" id="show-bid-number-of-openings" name="number_of_openings" value="{{$bid->number_of_openings}}" disabled>
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-bid-team">Team</label>
                    <input type=text class="form-control" id="show-bid-team" name="team_id" value="{{$bid->team->description}}" disabled>
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-bid-shift">Shift</label>
                    <input type=text class="form-control" id="show-bid-shift" name="shift_id" value="{{$bid->shift->description}}" disabled>
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-bid-position">Position</label>
                    <input type=text class="form-control" id="show-bid-position" name="position_id" value="{{$bid->position->description}}" disabled>
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-bid-bid-top-wage">Top Wage</label>
                    <input type=text class="form-control" id="show-bid-bid-top-wage" name="bid_top_wage_id" value="${{$bid->bidTopWage->amount}}" disabled>
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-bid-bid-education-top-wage">Top Wage With Education</label>
                    <input type=text class="form-control" id="show-bid-bid-education-top-wage" name="bid_education_top_wage_id" value="${{$bid->bidEducationTopWage->amount}}" disabled>
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-bid-education-requirement">Education Requirement</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input type="checkbox" id="show-bid-education-requirement" name="education_requirement" {{$bid->education_requirement == 1 ? 'checked' : ''}}>
                            </div>
                        </div>
                        <input type="text" class="form-control" value="Is top pay limited by education" disabled>
                    </div>
                </div>

                <!-- <div class="form-group col-md-6 col-lg-4 d-flex">
                    <div class="custom-control custom-checkbox my-auto">
                        <input type="checkbox" class="custom-control-input" id="show-bid-education-requirement" name="education_requirement" {{$bid->education_requirement == 1 ? 'checked' : ''}} disabled>
                        <label for="show-bid-education-requirement" class="custom-control-label">Is top pay limited by education</label>
                    </div>
                </div> -->

                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-bid-resume-required">Resume Requirement</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input type="checkbox" id="show-bid-resume-required" name="resume_required" {{$bid->resume_required == 1 ? 'checked' : ''}}>
                            </div>
                        </div>
                        <input type="text" class="form-control" value="Is a resume required" disabled>
                    </div>
                </div>

                <!-- <div class="form-group col-md-6 col-lg-4 d-flex">
                    <div class="custom-control custom-checkbox my-auto">
                        <input type="checkbox" class="custom-control-input" id="show-bid-resume-required" name="resume_required" {{$bid->resume_required == 1 ? 'checked' : ''}} disabled>
                        <label for="show-bid-resume-required" class="custom-control-label">Is a resume required</label>
                    </div>
                </div> -->

                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-bid-tech-form-required">Tech Form Requirement</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input type="checkbox" id="show-bid-tech-form-required" name="tech_form_required" {{$bid->tech_form_required == 1 ? 'checked' : ''}}>
                            </div>
                        </div>
                        <input type="text" class="form-control" value="Is a tech form required" disabled>
                    </div>
                </div>

                <!-- <div class="form-group col-md-6 col-lg-4 d-flex">
                    <div class="custom-control custom-checkbox my-auto">
                        <input type="checkbox" class="custom-control-input" id="show-bid-tech-form-required" name="tech_form_required" {{$bid->tech_form_required == 1 ? 'checked' : ''}} disabled>
                        <label for="show-bid-tech-form-required" class="custom-control-label">Is a tech form required</label>
                    </div>
                </div> -->

                <div class="form-group col-12">
                    <label for="show-bid-summary">Summary</label>
                    <textarea class="form-control" id="show-bid-summary" rows="3" name="summary" disabled>{{$bid->summary}}</textarea>
                </div>

                <div class="form-group col-12">
                    <label for="show-bid-essential-duties-responsibilities">Essential Duties And Responsibilities</label>
                    <textarea class="form-control" id="show-bid-essential-duties-responsibilities" rows="3" name="essential_duties_responsibilities" disabled>{{$bid->essential_duties_responsibilities}}</textarea>
                </div>

                <div class="form-group col-12">
                    <label for="show-bid-qualifications">Qualifications</label>
                    <textarea class="form-control" id="show-bid-qualifications" rows="3" name="qualifications" disabled>{{$bid->qualifications}}</textarea>
                </div>

                <div class="form-group col-12">
                    <label for="show-bid-successful-bidder">Successful Bidder Must Be Able To</label>
                    <textarea class="form-control" id="show-bid-successful-bidder" rows="3" name="successful_bidder" disabled>{{$bid->successful_bidder}}</textarea>
                </div>

                <div class="form-group col-12">
                    <label for="show-bid-education-experience">Education And/Or Experience</label>
                    <textarea class="form-control" id="show-bid-education-experience" rows="3" name="education_experience" disabled>{{$bid->education_experience}}</textarea>
                </div>

                <div class="form-group col-12">
                    <label for="show-bid-physical-demand">Physical Demands</label>
                    <textarea class="form-control" id="show-bid-physical-demand" rows="3" name="physical_demands" disabled>{{$bid->physical_demands}}</textarea>
                </div>

                <div class="form-group col-12">
                    <label for="show-bid-math-skills">Math Skills</label>
                    <textarea class="form-control" id="show-bid-math-skills" rows="3" name="math_skills" disabled>{{$bid->math_skills}}</textarea>
                </div>

            </div>

            <a href="{{route('bids.edit', $bid->id)}}" class="btn btn-edit mt-4">Edit Bid</a>
        </form>

        <hr></hr>
        <hr></hr>

@endsection