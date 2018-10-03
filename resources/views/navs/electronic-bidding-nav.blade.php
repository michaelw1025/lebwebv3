
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 py-1 shadow">
    <a class="navbar-brand ml-4 text-primary">LebWeb</a>
    @if(isset($employee))
    <a class="mx-auto btn btn-danger" href="{{route('electronic-bidding.index')}}" id="cancel-bidding-button">{{$employee->first_name}} {{$employee->last_name}} -- Click Here To Cancel Bidding <span class="badge badge-light"><span class="electronic-bidding-minutes">01</span>:<span class="electronic-bidding-seconds">30</span></span></a>
    @else
    <a class="mx-auto btn btn-info" href="#">To Start Bidding Please Scan Your Badge</a>
    @endif
    <a class="navbar-brand mr-4 btn btn-warning text-dark" href="#"><i class="fas fa-question-circle fa-lg"></i> Help</a>
</nav>