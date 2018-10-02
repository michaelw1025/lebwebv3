<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-light">
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
    <link href="{{ mix('/css/bid.css') }}" rel="stylesheet">

</head>
<body class="bg-transparent">

    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 py-1 shadow">
      <a class="navbar-brand ml-4 text-primary" href="#">LebWeb</a>
      <a class="mx-auto btn btn-info" href="">Start Bidding</a>
      <a class="navbar-brand mr-4 btn btn-warning text-dark" href="#"><i class="fas fa-question-circle fa-lg"></i> Help</a>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-3 bg-light sidebar text-center">
          <div class="sidebar-sticky">
                <div>
                    <a href="" class="btn btn-primary btn-lg btn-block" style="border-radius: 0;"><i class="fas fa-long-arrow-alt-left fa-lg"></i> View Open Bids</a>
                </div>
                <hr>
                <div>
                    <h4>John Doe</h4>
                </div>
                <div class="mb-3">
                    <a href="" class="btn btn-success btn-lg btn-block" style="border-radius: 0;">Add This Job To My Bids</a>
                </div>
                <hr>
                <h5>Current Bids</h5>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-arrow-alt-circle-up fa-lg text-success"></i></span>
                        <span class="input-group-text"><i class="far fa-arrow-alt-circle-down fa-lg text-edit"></i></span>
                    </div>
                    <input type="text" class="form-control" disabled value="18-100 Specialist Welding - Nights">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-minus-circle fa-lg text-danger"></i></span>
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-arrow-alt-circle-up fa-lg text-success"></i></span>
                        <span class="input-group-text"><i class="far fa-arrow-alt-circle-down fa-lg text-edit"></i></span>
                    </div>
                    <input type="text" class="form-control" disabled value="18-101 Maintenance Component - Days">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-minus-circle fa-lg text-danger"></i></span>
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-arrow-alt-circle-up fa-lg text-success"></i></span>
                        <span class="input-group-text"><i class="far fa-arrow-alt-circle-down fa-lg text-edit"></i></span>
                    </div>
                    <input type="text" class="form-control" disabled value="18-102 Machinist - Nights">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-minus-circle fa-lg text-danger"></i></span>
                    </div>
                </div>
                <div class="mb-3 mt-2">
                    <a href="" class="btn btn-site-logo btn-lg btn-block" style="border-radius: 0;">Complete Bidding</a>
                </div>

          </div>
        </div>

        <main role="main" class="col-9 ml-auto px-4 bg-transparent">
            <div class="row mb-2">
                <h3 class="text-primary ml-3">{{$bid->posting_number}} {{$bid->position->description}}</h3>
            </div>

            <div class="row mb-2">
                <div class="col-md-6 col-xl-4">
                <h5 class="py-2 pl-2 table-primary shadow"><span class="text-create">Posting Number:</span> {{$bid->posting_number}}</h5>
                </div>
                <div class="col-md-6 col-xl-4">
                <h5 class="py-2 pl-2 table-primary shadow"><span class="text-create">Post Date:</span> {{$bid->post_date->format('m/d/Y')}}</h5>
                </div>
                <div class="col-md-6 col-xl-4">
                <h5 class="py-2 pl-2 table-primary shadow"><span class="text-create">Pull Date:</span> {{$bid->pull_date->format('m/d/Y')}}</h5>
                </div>
                <div class="col-md-6 col-xl-4">
                <h5 class="py-2 pl-2 table-primary shadow"><span class="text-create">Shift:</span> {{$bid->shift->description}}s</h5>
                </div>
                <div class="col-md-6 col-xl-4">
                <h5 class="py-2 pl-2 table-primary shadow"><span class="text-create">Openings:</span> {{$bid->number_of_openings}}</h5>
                </div>
            </div>

            <hr class="m-0 p-0 mb-3">

            <div class="row mt-3 mb-2">
                <div class="col-md-6 col-xl-4">
                    <h5 class="py-2 pl-2 table-primary shadow"><span class="text-create">Team:</span> {{$bid->team->description}}</h5>
                </div>
                <div class="col-md-6 col-xl-4">
                    <h5 class="py-2 pl-2 table-primary shadow"><span class="text-create">Position:</span> {{$bid->position->description}}</h5>
                </div>
                <div class="col-md-6 col-xl-4">
                    <h5 class="py-2 pl-2 table-primary shadow"><span class="text-create">Top Pay:</span> ${{$bid->bidTopWage->amount}}</h5>
                </div>
                <div class="col-md-6 col-xl-4">
                    <h5 class="py-2 pl-2 table-primary shadow"><span class="text-create">Top Pay With Education:</span> ${{$bid->bidEducationTopWage->amount}}</h5>
                </div>
                <div class="col-md-6 col-xl-4">
                    <h5 class="py-2 pl-2 table-primary shadow"><span class="text-create">Education Requirement:</span> {{$bid->education_requirement == 1 ? 'Yes' : 'No'}}</h5>
                </div>
                <div class="col-md-6 col-xl-4">
                    <h5 class="py-2 pl-2 table-primary shadow"><span class="text-create">Resume Required:</span> {{$bid->resume_required == 1 ? 'Yes' : 'No'}}</h5>
                </div>
                <div class="col-md-6 col-xl-4">
                    <h5 class="py-2 pl-2 table-primary shadow"><span class="text-create">Tech Form Required:</span> {{$bid->tech_form_required == 1 ? 'Yes' : 'No'}}</h5>
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


</body>
</html>
