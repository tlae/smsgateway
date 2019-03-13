@extends('layouts.app')
@section('content')
<div class="container content">
    <div class="row">
        <div class="col-sm">
          <div class="card">
            <div class="card-header"> New Chat</div>
            @include('layouts._messages')
            <div class="card-body height3">
                <form id="chatForm" action="{{ route('messages.chat.store', $id) }}" method="post">
                  @csrf
                  <div class="form-group">
                    <label for="chat-title">chat Tittle </label>
                    <input type="text" name="title" value="{{ old('title', $chat->title) }}" id="chat-title" class=" form-control {{ $errors->has('title') ? 'is-invalid' : '' }}">

                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                          <strong>{{ $errors->first('title') }}</strong>
                        </div>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="chat-summary">Executive summary</label>
                    <textarea name="summary" id="chat-summary" rows="7" class="form-control {{ $errors->has('summary') ? 'is-invalid' : '' }}">{{ old('summary', $chat->summary) }}</textarea>

                    @if ($errors->has('summary'))
                      <div class="invalid-feedback">
                        <strong>{{ $errors->first('summary') }}</strong>
                      </div>
                    @endif
                  </div>
                  
                <div class="form-group">
                    <button  type="submit" class="btn btn-outline-primary btn-lg" >Create chat</button>
                </div>
              </form>          
              
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
