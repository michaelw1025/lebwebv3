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
<body class="show-bids-background">

    <nav class="site-header sticky-top px-2">
        <a href="{{route('electronic-bidding.index')}}" class="navbar-brand text-primary">LebWeb</a>
        <a href="{{route('electronic-bidding.index')}}" class="text-white">Show All Bids</a>
    </nav>
    <div class="container-fluid">
        <div class="row">
            @foreach($bids as $bid)
            <div class="col-md-6 col-xxl-3">
                <div class="card bid-card shadow mb-1 mt-2" data-href="{{route('electronic-bidding.show', ['id' => $bid->id])}}">
                    <div class="card-body py-2">
                        <h5 class="m-0 p-0">{{$bid->posting_number}} {{$bid->position->description}}</h5>
                        <hr class="mt-1 mb-2 p-0">
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text bid-card-input-label text-primary">Post Date</span>
                            </div>
                            <input type="text" class="form-control font-weight-bold bid-card-input" value="{{$bid->post_date->format('m/d/Y')}}" disabled>
                        </div>
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text bid-card-input-label text-primary">Pull Date</span>
                            </div>
                            <input type="text" class="form-control font-weight-bold bid-card-input" value="{{$bid->pull_date->format('m/d/Y')}}" disabled>
                        </div>
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text bid-card-input-label text-primary">Team</span>
                            </div>
                            <input type="text" class="form-control font-weight-bold bid-card-input" value="{{$bid->team->description}}" disabled>
                        </div>
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text bid-card-input-label text-primary">Position</span>
                            </div>
                            <input type="text" class="form-control font-weight-bold bid-card-input" value="{{$bid->position->description}}" disabled>
                        </div>
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text bid-card-input-label text-primary">Shift</span>
                            </div>
                            <input type="text" class="form-control font-weight-bold bid-card-input" value="{{$bid->shift->description}}" disabled>
                        </div>
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text bid-card-input-label text-primary">Openings</span>
                            </div>
                            <input type="text" class="form-control font-weight-bold bid-card-input" value="{{$bid->number_of_openings}}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</body>
</html>
