<!-- Modal -->
@php
$chat = new App\Chat();
@endphp

<div class="modal fade" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-xl-center" id="chatTitle">New Chat</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form id="chatForm" action="" method="post">
          @csrf
          <div class="modal-body">
            @include('chats._chatform')
          </div>
          <div class="modal-footer">
           <div class="form-group">
            <button  type="submit" class="btn btn-outline-primary btn-lg" >Create chat</button>
            <button type="button"  class="btn btn-secondary btn-lg ml-2" data-dismiss="modal">Close</button>
           </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>