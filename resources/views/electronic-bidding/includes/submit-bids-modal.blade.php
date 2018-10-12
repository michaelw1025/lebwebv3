<div class="modal fade" id="submit-bids-modal" tabindex="-1" role="dialog" aria-labelledby="submit-bids-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-success" id="submit-bids-modal-label">Submit My Bids</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle fa-lg text-danger" aria-hidden="true"></i>
        </button>
      </div>
      <form action="{{route('electronic-bidding.submit-bids')}}" method="POST">
        @csrf
        <div class="modal-body">
          <h5>Please review your selected bids.  Ensure that your choice in bids are in the correct order.  If you need to adjust the bid order please click on the "Return To My Bids" button.  If you are satisfied with your choice of bids please click the "Complete Bidding" button.</h5>
          <input type="text" name="bidder_id" class="d-none" value="{{isset($employee) ? $employee->id : ''}}">
            <div id="submit-bids-modal-body" class="col">

            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Return To My Bids</button>
          <button type="submit" class="btn btn-success">Complete Bidding</button>
        </div>
      </form>
    </div>
  </div>
</div>