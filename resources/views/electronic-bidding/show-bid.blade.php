@extends('layouts.electronic-bidding-app')

@section('content')

<div class="container-fluid">
    <div class="row">

        @include('sidebars.electronic-bidding-sidebar')

        <main role="main" class="col-9 ml-auto px-4 bg-transparent show-bid-page">
            <div class="row mb-2">
                <h3 class="text-primary ml-3 bid-name" id="{{$bid->id}}">{{$bid->posting_number}} {{$bid->position->description}}</h3>
                <p class="d-none bid-id-number" id="{{$bid->id}}"></p>
            </div>

            <div class="row mb-2">
                <div class="col-md-6 col-xl-4">
                    <h5 class="py-2 pl-2 table-primary shadow"><span class="text-create">Posting Number:</span>
                        {{$bid->posting_number}}</h5>
                </div>
                <div class="col-md-6 col-xl-4">
                    <h5 class="py-2 pl-2 table-primary shadow"><span class="text-create">Post Date:</span>
                        {{$bid->post_date->format('m/d/Y')}}</h5>
                </div>
                <div class="col-md-6 col-xl-4">
                    <h5 class="py-2 pl-2 table-primary shadow"><span class="text-create">Pull Date:</span>
                        {{$bid->pull_date->format('m/d/Y')}}</h5>
                </div>
                <div class="col-md-6 col-xl-4">
                    <h5 class="py-2 pl-2 table-primary shadow"><span class="text-create">Shift:</span>
                        <span class="bid-shift">{{$bid->shift->description}}s</span></h5>
                </div>
                <div class="col-md-6 col-xl-4">
                    <h5 class="py-2 pl-2 table-primary shadow"><span class="text-create">Openings:</span>
                        {{$bid->number_of_openings}}</h5>
                </div>
            </div>

            <hr class="m-0 p-0 mb-3">

            <div class="row mt-3 mb-2">
                <div class="col-md-6 col-xl-4">
                    <h5 class="py-2 pl-2 table-primary shadow"><span class="text-create">Team:</span>
                        {{$bid->team->description}}</h5>
                </div>
                <div class="col-md-6 col-xl-4">
                    <h5 class="py-2 pl-2 table-primary shadow"><span class="text-create">Position:</span>
                        {{$bid->position->description}}</h5>
                </div>
                <div class="col-md-6 col-xl-4">
                    <h5 class="py-2 pl-2 table-primary shadow"><span class="text-create">Top Pay:</span>
                        ${{$bid->bidTopWage->amount}}</h5>
                </div>
                <div class="col-md-6 col-xl-4">
                    <h5 class="py-2 pl-2 table-primary shadow"><span class="text-create">Top Pay With Education:</span>
                        ${{$bid->bidEducationTopWage->amount}}</h5>
                </div>
                <div class="col-md-6 col-xl-4">
                    <h5 class="py-2 pl-2 table-primary shadow"><span class="text-create">Education Requirement:</span>
                        {{$bid->education_requirement == 1 ? 'Yes' : 'No'}}</h5>
                </div>
                <div class="col-md-6 col-xl-4">
                    <h5 class="py-2 pl-2 table-primary shadow"><span class="text-create">Resume Required:</span>
                        {{$bid->resume_required == 1 ? 'Yes' : 'No'}}</h5>
                </div>
                <div class="col-md-6 col-xl-4">
                    <h5 class="py-2 pl-2 table-primary shadow"><span class="text-create">Tech Form Required:</span>
                        {{$bid->tech_form_required == 1 ? 'Yes' : 'No'}}</h5>
                </div>
            </div>

            <hr class="m-0 p-0">

            <div class="row mt-2">
                <div class="col-12">
                    <pre class="h6 shadow table-primary p-2" style="font-family: Roboto; white-space: pre-line;"><span class="h4 text-create"><u>Summary</u></span> <br><br>{{$bid->summary}}</pre>
                </div>

                <div class="col-12 col-md-6">
                    <pre class="h6 shadow table-primary p-2" style="font-family: Roboto; white-space: pre-line;"><span class="h4 text-create"><u>Essential Duties/Responsibilities</u></span> <br><br>{{$bid->essential_duties_responsibilities}}</pre>
                </div>

                <div class="col-12 col-md-6">
                    <pre class="h6 shadow table-primary p-2" style="font-family: Roboto; white-space: pre-line;"><span class="h4 text-create"><u>Qualifications</u></span> <br><br>{{$bid->qualifications}}</pre>

                    <pre class="h6 shadow table-primary p-2" style="font-family: Roboto; white-space: pre-line;"><span class="h4 text-create"><u>Successfull Bidder Must Be Able To</u></span> <br><br>{{$bid->successful_bidder}}</pre>

                    <pre class="h6 shadow table-primary p-2" style="font-family: Roboto; white-space: pre-line;"><span class="h4 text-create"><u>Education/Experience</u></span> <br><br>{{$bid->education_experience}}</pre>

                    <pre class="h6 shadow table-primary p-2" style="font-family: Roboto; white-space: pre-line;"><span class="h4 text-create"><u>Physical Demands</u></span> <br><br>{{$bid->physical_demands}}</pre>

                    <pre class="h6 shadow table-primary p-2" style="font-family: Roboto; white-space: pre-line;"><span class="h4 text-create"><u>Math Skills</u></span> <br><br>{{$bid->math_skills}}</pre>
                </div>


            </div>



        </main>
    </div>
</div>

@endsection
