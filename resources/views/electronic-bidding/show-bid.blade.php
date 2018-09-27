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

    <nav class="site-header sticky-top px-2 shadow-sm">
        <a href="{{route('electronic-bidding.index')}}" class="navbar-brand text-primary">LebWeb</a>
        <a href="{{route('electronic-bidding.index')}}" class="text-header">Show All Bids</a>
    </nav>
    <div class="container-fluid mt-3">
        <div class="row px-2 mb-2">
            <div class="col-md-6 col-xl-4">
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
            </div>
        </div>
        <hr class="m-0 p-0">
        <div class="row px-2 mt-3 mb-2">
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
        </div>
    </div>

</body>
</html>
