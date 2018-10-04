@if(isset($employee))

    @else
        <a href="{{route('electronic-bidding.index-with-bidder')}}" id="index-with-bidder-link" class="d-none"></a>
@endif