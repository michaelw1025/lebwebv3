@if(isset($employee))
    <form name="reset-electronic-bidding-timer" id="reset-electronic-bidding-timer" style="position: absolute; top: -9999px; left: -9999px;" autocomplete="off">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control form-control-sm" id="reset-electronic-bidding-timer-input" name="employee_id" autofocus>
        </div>
    </form>
    @else
    <form name="electronic-bidding-badge-number-submit-form" id="electronic-bidding-badge-number-submit-form" action="{{route('electronic-bidding.get-bidder')}}" method="post" style="position: absolute; top: -9999px; left: -9999px;" autocomplete="off">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control form-control-sm" id="electronic-bidding-badge-number" name="employee_id" autofocus>
        </div>
        <a href="{{route('electronic-bidding.get-bidder')}}" id="index-with-bidder-link"></a>
    </form>
@endif