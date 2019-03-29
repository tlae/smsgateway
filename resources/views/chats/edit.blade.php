@extends('layouts.app')
@section('content')
<div class="container content">
    <div class="row">
        <div class="col-sm">
          <div class="card">
            <div class="card-header">
              <div class="d-flex align-items-center">
                 <h3>Edit Chat</h3>
                <div class="ml-auto">
                   <a href="{{ route('chats.show', $chat->slug) }}" title="Back to chat" class="back">
                     <i class="fas fa-undo-alt fa-2x"></i>
                   </a>
                </div>
              </div>
            

            </div>
            @include('layouts._messages')
            <div class="card-body height3">
                <form id="chatForm" action="{{ route('chats.update', $chat->slug) }}" method="post">
                  {{ method_field('PUT') }}
                  @csrf
                  <div class="form-group">
                    <label for="chat-title">Chat Tittle </label>
                    <input type="text" name="title" value="{{ $chat->title}}" id="chat-title" class=" form-control {{ $errors->has('title') ? 'is-invalid' : '' }}">

                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                          <strong>{{ $errors->first('title') }}</strong>
                        </div>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="chat-summary">Executive Summary</label>
                    <textarea name="summary" id="chat-summary" rows="7" class="form-control {{ $errors->has('summary') ? 'is-invalid' : '' }}">{{ $chat->summary }}</textarea>

                    @if ($errors->has('summary'))
                      <div class="invalid-feedback">
                        <strong>{{ $errors->first('summary') }}</strong>
                      </div>
                    @endif
                  </div>
                  
                <div class="form-group">
                    <button  type="submit" class="btn btn-outline-primary btn-lg" >Update chat</button>
                </div>
              </form>          
              
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
