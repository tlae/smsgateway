 <div class="row mt-4">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="card-tittle">
              <h3>Reply Message</h3>
            </div>
                @php
                  $message = $messages->find($messages->first()->phone->last_message_id);
                @endphp
                
               <form method="post" action="{{ route('messages.replies.store', $message->id)}}" >
                @csrf
                <div class="form-group">
                  <textarea name="body" id="" rows="7" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }} " ></textarea>
                  @if ($errors->has('body'))
                      <div class="invalid-feedback">
                          <strong>{{ $errors->first('body') }}</strong>
                      </div>
                  @endif
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-lg btn-outline-primary">Submit</button>
                </div>
              </form>
            
          </div>
        </div>
      </div>
    </div>
