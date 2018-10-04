
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 py-1 shadow-sm">
    <a class="navbar-brand ml-4 text-primary">LebWeb</a>

    @if(isset($employee))
    <a class="mx-auto btn btn-warning" href="{{route('electronic-bidding.index')}}" id="cancel-bidding-button">{{$employee->first_name}} {{$employee->last_name}} -- Click Here To Cancel Bidding <span class="badge badge-light bidding-timer-badge"></span></a>
    @else
    <a class="mx-auto btn btn-info" href="#">To Start Bidding Please Scan Your Badge</a>
    @endif
    <a class="navbar-brand mr-4 btn btn-warning text-dark" href="#"><i class="fas fa-question-circle fa-lg"></i> Help</a>
</nav>