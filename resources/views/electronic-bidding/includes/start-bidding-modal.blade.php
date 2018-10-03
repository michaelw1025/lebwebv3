<!-- <div class="modal" role="dialog" id="start-bidding">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Start Bidding</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>To start bidding please scan the barcode that is on your employee badge.  If you do not have a barcode on your employee badge please see the human resources department.</p>
            <form name="electronic-bidding-badge-number-submit-form" id="electronic-bidding-badge-number-submit-form" action="{{route('electronic-bidding.get-bidding-employee')}}" method="post">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" id="electronic-bidding-badge-number" name="employee_id" autofocus>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
</div> -->