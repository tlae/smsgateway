@extends('layouts.app')
@section('content')
<div class="container content">
    <div class="row">
        <div class="col-sm">
          <div class="card">
            <div class="card-header">{{ "Messages for" . " " . $msisdn }}
                 <div class="float-right">
                    <a href="{{route('messages.index')}}"  class="btn btn-outline-secondary"> Back to all Messages</a>
                  </div>
            </div>
            @include('layouts._messages')
            <div class="card-body height3">
              <ul class="chat-list">
                @foreach ($messages as $msg)
                <li class="in">
                  <div class="chat-img ">
                    <img alt="Avtar" src="http://bootdey.com/img/Content/avatar/avatar1.png">
                  </div>
                  <div class="chat-body">
                    <div class="chat-message">
                      <h5 class="text-muted">  {{ $msg->msisdn }}</h5>
                      <p>{{ $msg->body }}</p>
                      <span class="float-right text-muted">{{ $msg->created_date }}</span>
                    </div>
                  </div>
                </li>
                @if($msg->replies_count > 0)
                @foreach ($msg->replies as $reply)
                <li class="out">
                  <div class="chat-img">
                    <img alt="Avtar" src="http://bootdey.com/img/Content/avatar/avatar6.png">
                    {{-- <div class="out-user text-muted">{{ $reply->user->name }}</div> --}}
                  </div>
                  <div class="chat-body">
                    <div class="chat-message float-right">
                      <p>{{ $reply->body }}</p>
                      <span class="float-right text-muted"> {{ " - " . $reply->created_date }}</span>
                      <span class="text-gray-dark float-right">{{ "By " . $reply->user->name . " - "}}</span>
                    </div>

                  </div>
                </li>
                @endforeach
                @endif

            @endforeach
              
              </ul>
            </div>
          </div>
        </div>
    </div>
    @include('replies._create')
</div>
@endsection