@extends('layouts.electronic-bidding-app')

@section('content')

    <div class="container-fluid" role="main">
        <div class="row">
            @foreach($bids as $bid)
            <div class="col-md-6 col-xxl-3">
                <div class="card bid-card shadow mb-1 mt-2" data-href="{{isset($employee) ? route('electronic-bidding.show-with-bidder', ['id' => $bid->id, 'bidder' => $employee->id])  : route('electronic-bidding.show', ['id' => encrypt($bid->id)])}}">
                    <div class="card-body py-2">
                        <h5 class="m-0 p-0">{{$bid->posting_number}} <span class="text-create">{{$bid->position->description}}</span></h5>
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

@endsection
