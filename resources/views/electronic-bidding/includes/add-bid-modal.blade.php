<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLabel">Add to My Bids</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle fa-lg text-danger" aria-hidden="true"></i>
        </button>
      </div>
      <div class="modal-body">
        <h4>To add <span class="text-create">{{$bid->posting_number}} {{$bid->position->description}}</span> to My Bids please scan your employee badge barcode.</h4>
      </div>
    </div>
  </div>
</div>