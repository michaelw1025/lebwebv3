<div class="col-3 bg-light sidebar text-center">
    <div class="sidebar-sticky">
        <div>
            @if(isset($employee))
            <div>
                <h4>{{$employee->first_name}} {{$employee->last_name}} <span class="badge badge-warning bidding-timer-badge"
                        id="bidding-timer-badge"></span></h4>
            </div>
            <hr>
            <h5 id="my-bids-header">My Bids</h5>
            @if(isset($myBids))
            @foreach($myBids as $myBid)
            <div class="input-group my-bids">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-arrow-alt-circle-up fa-lg text-success"></i></span>
                    <span class="input-group-text"><i class="far fa-arrow-alt-circle-down fa-lg text-edit"></i></span>
                </div>
                <input type="text" class="form-control" id="{{$myBid->id}}" disabled value="{{$myBid->posting_number}} {{$myBid->position->description}} - {{$myBid->shift->description}}">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-minus-circle fa-lg text-danger"></i></span>
                </div>
            </div>
            @endforeach
            @else
            <p class="lead text-danger my-bids-empty">None</p>
            @endif
            
            <hr>
            @endif
            @if(!in_array(Route::currentRouteName(), array('electronic-bidding.index-with-bidder',
            'electronic-bidding.index') ))
            @if(isset($employee))
            <div class="mb-3">
                <a href="{{route('electronic-bidding.index-with-bidder', ['bidder' => $employee->id])}}" id="view-open-bids-link" class="btn btn-primary btn-lg btn-block" style="border-radius: 0;"><i class="fas fa-long-arrow-alt-left fa-lg"></i> View Open Bids</a>
            </div>
            <div class="mb-3">
                <button class="btn btn-success btn-lg btn-block" style="border-radius: 0;" id="add-bid">Add This Bid To My Bids</button>
            </div>
            @else
            <a href="{{route('electronic-bidding.index')}}" id="view-open-bids-link" class="btn btn-primary btn-lg btn-block" style="border-radius: 0;"><i class="fas fa-long-arrow-alt-left fa-lg"></i> View Open Bids</a>
            @endif
            <hr>
            @endif
        </div>


        <!-- 
        <hr>

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
        </div> -->

    </div>
</div>
