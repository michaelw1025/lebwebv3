<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="show-bids-background">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LebWebDev') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('/js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

</head>
<body class="bg-transparent">

    <nav class="site-header sticky-top px-2 shadow-sm bg-white">
        <a href="{{route('electronic-bidding.index')}}" class="navbar-brand text-primary">LebWeb</a>
        <a href="{{route('electronic-bidding.index')}}" class="text-header">Show All Bids</a>
    </nav>
    <div class="container-fluid mt-3">

        <!-- <div class="row mb-2"> -->
            <!-- <div class="col-md-6 col-xl-4">
            <h5 class="py-2 pl-2 semi-transparent-white-bg shadow"><span class="text-create">Posting Number:</span> {{$bid->posting_number}}</h5>
            </div>
            <div class="col-md-6 col-xl-4">
            <h5 class="py-2 pl-2 semi-transparent-white-bg shadow"><span class="text-create">Post Date:</span> {{$bid->post_date->format('m/d/Y')}}</h5>
            </div>
            <div class="col-md-6 col-xl-4">
            <h5 class="py-2 pl-2 semi-transparent-white-bg shadow"><span class="text-create">Pull Date:</span> {{$bid->pull_date->format('m/d/Y')}}</h5>
            </div>
            <div class="col-md-6 col-xl-4">
            <h5 class="py-2 pl-2 semi-transparent-white-bg shadow"><span class="text-create">Shift:</span> {{$bid->shift->description}}s</h5>
            </div>
            <div class="col-md-6 col-xl-4">
            <h5 class="py-2 pl-2 semi-transparent-white-bg shadow"><span class="text-create">Openings:</span> {{$bid->number_of_openings}}</h5>
            </div> -->
        <!-- </div>
        <hr class="m-0 p-0"> -->
        <!-- <div class="row px-2 mt-3 mb-2">
            <div class="col-md-6 col-xl-4">
                <h5 class="py-2 pl-2 semi-transparent-white-bg shadow"><span class="text-create">Team:</span> {{$bid->team->description}}</h5>
            </div>
            <div class="col-md-6 col-xl-4">
                <h5 class="py-2 pl-2 semi-transparent-white-bg shadow"><span class="text-create">Position:</span> {{$bid->position->description}}</h5>
            </div>
            <div class="col-md-6 col-xl-4">
                <h5 class="py-2 pl-2 semi-transparent-white-bg shadow"><span class="text-create">Top Pay:</span> ${{$bid->bidTopWage->amount}}</h5>
            </div>
            <div class="col-md-6 col-xl-4">
                <h5 class="py-2 pl-2 semi-transparent-white-bg shadow"><span class="text-create">Top Pay With Education:</span> ${{$bid->bidEducationTopWage->amount}}</h5>
            </div>
            <div class="col-md-6 col-xl-4">
                <h5 class="py-2 pl-2 semi-transparent-white-bg shadow"><span class="text-create">Education Requirement:</span> {{$bid->education_requirement == 1 ? 'Yes' : 'No'}}</h5>
            </div>
            <div class="col-md-6 col-xl-4">
                <h5 class="py-2 pl-2 semi-transparent-white-bg shadow"><span class="text-create">Resume Required:</span> {{$bid->resume_required == 1 ? 'Yes' : 'No'}}</h5>
            </div>
            <div class="col-md-6 col-xl-4">
                <h5 class="py-2 pl-2 semi-transparent-white-bg shadow"><span class="text-create">Tech Form Required:</span> {{$bid->tech_form_required == 1 ? 'Yes' : 'No'}}</h5>
            </div>
        </div>
        <hr class="m-0 p-0">
        <div class="row px-2 mt-3 mb-2">
            <div class="col-12">
                <p class="py-2 pl-2 semi-transparent-white-bg shadow"><span class="text-create h5">Summary:</span> {{$bid->summary}}</p>
            </div>
            <div class="col-6">
                <p class="py-2 pl-2 semi-transparent-white-bg shadow"><span class="text-create h5">Essential Duties And Responsibilities:</span> {{$bid->essential_duties_responsibilities}}</p>
            </div>
            <div class="col-6">
                <p class="py-2 pl-2 semi-transparent-white-bg shadow"><span class="text-create h5">Qualifications:</span> {{$bid->qualifications}}</p>
                <p class="py-2 pl-2 semi-transparent-white-bg shadow"><span class="text-create h5">Successful Bidder Must Be Able To:</span> {{$bid->successful_bidder}}</p>
            </div>
            <div class="col-6">
                <p class="py-2 pl-2 semi-transparent-white-bg shadow"><span class="text-create h5">Education/Experience:</span> {{$bid->education_experience}}</p>
            </div>
            <div class="col-6">
                <p class="py-2 pl-2 semi-transparent-white-bg shadow"><span class="text-create h5">Physical Demands:</span> {{$bid->physical_demands}}</p>
            </div>
            <div class="col-6">
                <p class="py-2 pl-2 semi-transparent-white-bg shadow"><span class="text-create h5">Math Skills:</span> {{$bid->math_skills}}</p>
            </div>
        </div> -->

        <div class="row">

            <div class="col-md-6 col-xl-4 ">
                <div class="input-group mb-3 semi-transparent-white-bg shadow">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-create text-white" style="border: 0; background: transparent;">Posting Number</span>
                    </div>
                    <input type="text" class="form-control" value="{{$bid->posting_number}}" style="border: 0; background: transparent;" disabled>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 ">
                <div class="input-group mb-3 semi-transparent-white-bg shadow">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-create text-white" style="border: 0; background: transparent;">Post Date</span>
                    </div>
                    <input type="text" class="form-control" value="{{$bid->post_date->format('m/d/Y')}}" style="border: 0; background: transparent;" disabled>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 ">
                <div class="input-group mb-3 semi-transparent-white-bg shadow">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-create text-white" style="border: 0; background: transparent;">Pull Date</span>
                    </div>
                    <input type="text" class="form-control" value="{{$bid->pull_date->format('m/d/Y')}}" style="border: 0; background: transparent;" disabled>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 ">
                <div class="input-group mb-3 semi-transparent-white-bg shadow">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-create text-white" style="border: 0; background: transparent;">Shift</span>
                    </div>
                    <input type="text" class="form-control" value="{{$bid->shift->description}}" style="border: 0; background: transparent;" disabled>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 ">
                <div class="input-group mb-3 semi-transparent-white-bg shadow">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-create text-white" style="border: 0; background: transparent;">Openings</span>
                    </div>
                    <input type="text" class="form-control" value="{{$bid->number_of_openings}}" style="border: 0; background: transparent;" disabled>
                </div>
            </div>

        </div>

        <hr class="m-0 p-0 mb-3">

        <div class="row">

            <div class="col-md-6 col-xl-4 ">
                <div class="input-group mb-3 semi-transparent-white-bg shadow">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-create text-white" style="border: 0; background: transparent;">Team</span>
                    </div>
                    <input type="text" class="form-control" value="{{$bid->team->description}}" style="border: 0; background: transparent;" disabled>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 ">
                <div class="input-group mb-3 semi-transparent-white-bg shadow">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-create text-white" style="border: 0; background: transparent;">Position</span>
                    </div>
                    <input type="text" class="form-control" value="{{$bid->position->description}}" style="border: 0; background: transparent;" disabled>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 ">
                <div class="input-group mb-3 semi-transparent-white-bg shadow">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-create text-white" style="border: 0; background: transparent;">Top Wage</span>
                    </div>
                    <input type="text" class="form-control" value="{{$bid->bidTopWage->amount}}" style="border: 0; background: transparent;" disabled>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 ">
                <div class="input-group mb-3 semi-transparent-white-bg shadow">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-create text-white" style="border: 0; background: transparent;">Top Pay With Education</span>
                    </div>
                    <input type="text" class="form-control" value="{{$bid->bidEducationTopWage->amount}}" style="border: 0; background: transparent;" disabled>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 ">
                <div class="input-group mb-3 semi-transparent-white-bg shadow">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-create text-white" style="border: 0; background: transparent;">Education Requirement</span>
                    </div>
                    <input type="text" class="form-control" value="{{$bid->education_requirement == 1 ? 'Yes' : 'No'}}" style="border: 0; background: transparent;" disabled>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 ">
                <div class="input-group mb-3 semi-transparent-white-bg shadow">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-create text-white" style="border: 0; background: transparent;">Resume Required</span>
                    </div>
                    <input type="text" class="form-control" value="{{$bid->resume_required == 1 ? 'Yes' : 'No'}}" style="border: 0; background: transparent;" disabled>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 ">
                <div class="input-group mb-3 semi-transparent-white-bg shadow">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-create text-white" style="border: 0; background: transparent;">Tech Form Required</span>
                    </div>
                    <input type="text" class="form-control" value="{{$bid->tech_form_required == 1 ? 'Yes' : 'No'}}" style="border: 0; background: transparent;" disabled>
                </div>
            </div>

        </div>

        <hr class="m-0 p-0 mb-3">

        <div class="row">
        
            <div class="col-12">
                <div class="input-group mb-3 semi-transparent-white-bg shadow mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-create text-white" style="border: 0; background: transparent;">Summary</span>
                    </div>
                    <textarea class="form-control" style="border: 0; background: transparent;" disabled>{{$bid->summary}}</textarea>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="input-group mb-3 semi-transparent-white-bg shadow mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-create text-white" style="border: 0; background: transparent;">Essential Duties And Responsibilities</span>
                    </div>
                    <textarea class="form-control" style="border: 0; background: transparent;" disabled>{{$bid->essential_duties_responsibilities}}</textarea>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="input-group mb-3 semi-transparent-white-bg shadow mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-create text-white" style="border: 0; background: transparent;">Qualifications</span>
                    </div>
                    <textarea class="form-control" style="border: 0; background: transparent;" disabled>{{$bid->qualifications}}</textarea>
                </div>

                <div class="input-group mb-3 semi-transparent-white-bg shadow mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-create text-white" style="border: 0; background: transparent;">Education/Experience</span>
                    </div>
                    <textarea class="form-control" style="border: 0; background: transparent;" disabled>{{$bid->education_experience}}</textarea>
                </div>

                <div class="input-group mb-3 semi-transparent-white-bg shadow mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-create text-white" style="border: 0; background: transparent;">Physical Demands</span>
                    </div>
                    <textarea class="form-control" style="border: 0; background: transparent;" disabled>{{$bid->physical_demands}}</textarea>
                </div>

                <div class="input-group mb-3 semi-transparent-white-bg shadow mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-create text-white" style="border: 0; background: transparent;">Math Skills</span>
                    </div>
                    <textarea class="form-control" style="border: 0; background: transparent;" disabled>{{$bid->math_skills}}</textarea>
                </div>

                <div class="input-group mb-3 semi-transparent-white-bg shadow mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-create text-white" style="border: 0; background: transparent;">Successful Bidder Must Be Able To</span>
                    </div>
                    <textarea class="form-control" style="border: 0; background: transparent;" disabled>{{$bid->successful_bidder}}</textarea>
                </div>
            </div>

            <!-- <div class="col-12 col-md-6">
                <div class="input-group mb-3 semi-transparent-white-bg shadow">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-create text-white" style="border: 0; background: transparent;">Successful Bidder Must Be Able To</span>
                    </div>
                    <textarea class="form-control" style="border: 0; background: transparent;" disabled>{{$bid->successful_bidder}}</textarea>
                </div>
            </div> -->

            <!-- <div class="col-12 col-md-6">
                <div class="input-group mb-3 semi-transparent-white-bg shadow">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-create text-white" style="border: 0; background: transparent;">Education/Experience</span>
                    </div>
                    <textarea class="form-control" style="border: 0; background: transparent;" disabled>{{$bid->education_experience}}</textarea>
                </div>
            </div> -->

            <!-- <div class="col-12 col-md-6">
                <div class="input-group mb-3 semi-transparent-white-bg shadow">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-create text-white" style="border: 0; background: transparent;">Physical Demands</span>
                    </div>
                    <textarea class="form-control" style="border: 0; background: transparent;" disabled>{{$bid->physical_demands}}</textarea>
                </div>
            </div> -->

            <!-- <div class="col-12 col-md-6">
                <div class="input-group mb-3 semi-transparent-white-bg shadow">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-create text-white" style="border: 0; background: transparent;">Math Skills</span>
                    </div>
                    <textarea class="form-control" style="border: 0; background: transparent;" disabled>{{$bid->math_skills}}</textarea>
                </div>
            </div> -->
        
        </div>


    </div>

</body>
</html>
