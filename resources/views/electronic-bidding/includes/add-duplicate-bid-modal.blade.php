<div class="modal fade" id="add-duplicate-bid-modal" tabindex="-1" role="dialog" aria-labelledby="add-duplicate-bid-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-danger" id="add-duplicate-bid-modal-label">Bid Already Added</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle fa-lg text-danger" aria-hidden="true"></i>
        </button>
      </div>
      <div class="modal-body">
        <h4>Bid <span class="text-create">{{$bid->posting_number}} {{$bid->position->description}}</span> has already been added to My Bids.</h4>
      </div>
    </div>
  </div>
</div>