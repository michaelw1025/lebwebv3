<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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

    <style>
        html, body{
            background-color: #2b9eb3;
        }
        .site-header {
            background-color: rgba(0, 0, 0, .85);
            -webkit-backdrop-filter: saturate(180%) blur(20px);
            backdrop-filter: saturate(180%) blur(20px);
        }
        .bid-card-input{
            background-color: #fff;
        }
        input[type="text"]:disabled{
            background-color: white;
        }
    </style>

</head>
<body class="">

    <nav class="site-header sticky-top px-2">
        <a href="{{route('home')}}" class="navbar-brand text-primary">LebWeb</a>
    </nav>
    <div class="container-fluid">
        <div class="row">
            @foreach($bids as $bid)
            <div class="col-md-6 col-xxl-3">
                <div class="card bid-card shadow mb-1 mt-2" data-href="{{route('electronic-bidding.show', ['id' => $bid->id])}}">
                    <div class="card-body">
                        <h5>18-101 Assembler</h5>
                        <hr>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text bid-card-input text-primary">Post Date</span>
                            </div>
                            <input type="text" class="form-control font-weight-bold" value="8/12/18" disabled>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text bid-card-input text-primary">Pull Date</span>
                            </div>
                            <input type="text" class="form-control font-weight-bold" value="8/19/18" disabled>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text bid-card-input text-primary">Team</span>
                            </div>
                            <input type="text" class="form-control font-weight-bold" value="Assembly" disabled>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text bid-card-input text-primary">Position</span>
                            </div>
                            <input type="text" class="form-control font-weight-bold" value="Assembler" disabled>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text bid-card-input text-primary">Shift</span>
                            </div>
                            <input type="text" class="form-control font-weight-bold" value="Night" disabled>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text bid-card-input text-primary">Openings</span>
                            </div>
                            <input type="text" class="form-control font-weight-bold" value="5" disabled>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</body>
</html>


        <!-- <div class="container-fluid  h-100">
            <div class="row h-100 m-0 p-0">
                <article class="w-100 show-bid-content m-0 p-0">
                    <div class="row">
                        @foreach($bids as $bid)
                        <div class="col-3 m-0 p-0 px-3">
                            <div class="card shadow">
                                <div class="card-body p-2">
                                    <h5 class="card-title text-primary">{{$bid->posting_number}} {{$bid->position->description}}</h5>
                                    <hr>
                                    <div class="form-group border border-light-gray rounded">
                                        <label for="" class="m-0 p-0 pt-1 pl-2 text-primary">Post Date</label>
                                        <input type="text" class="form-control-plaintext m-0 p-0 pb-1 pl-2 font-weight-bold" value="{{$bid->post_date->format('m/d/Y')}}" disabled>
                                    </div>
                                    <div class="form-group border border-light-gray rounded">
                                        <label for="" class="m-0 p-0 pt-1 pl-2 text-primary">Pull Date</label>
                                        <input type="text" class="form-control-plaintext m-0 p-0 pb-1 pl-2 font-weight-bold" value="{{$bid->pull_date->format('m/d/Y')}}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </article>
            </div>
        </div> -->


