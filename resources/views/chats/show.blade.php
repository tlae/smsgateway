@extends('layouts.app')
@section('content')

<div class="container content">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
           <div class="card-body">
            @include('layouts._messages')
            <div class="card-title">
                <div class="d-flex align-items-center">
                    <h5>{{ $chat->title }}</h5>
                    <div class="ml-auto">
                    <a href="{{route('chats.index')}}"  class="btn btn-outline-secondary"> Go to all Chats</a>
                    </div>
                    <div class="ml-auto">
                    <a href="{{route('messages.index')}}"  class="btn btn-outline-secondary"> Go to all messages</a>
                    </div>
                </div>   
            </div>
            <hr>
            <div class="media"> 
              <div class="d-flex flex-column action-control mr-4">
                  <a href="{{ route('chats.edit', $chat->slug ) }}" title="Edit chat information" class="edit">
                      <i class="far fa-edit fa-2x mb-2"></i>
                  </a>
                  <a href="" title="forward chat" class="forward">
                      <i class="far fa-share-square fa-2x mb-2"></i>
                  </a>
                  <a href="" title="Close chat" class="Close">
                      <i class="far fa-trash-alt fa-2x mb-2"></i>
                  </a>
              </div>  
               <div class="media-body">
                {!! $chat->summary_html !!}
                <div class="float-right mt-0 ">
                  <span class="text-primary"> <small> Created by {{$chat->user->name  }}</small></span>
                  <div class="media">
                      <span class="text-muted"> <small>On {{ $chat->created_at }}</small> </span>
                  </div>
                </div>      
               </div>
            </div>
           </div>
             
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
          <div class="card">
            <div class="card-header"> 
              <h3>Chat Conversations</h3>
              @php
              $messages = App\Message::with('replies.user')->where('chat_id', '=', $chat->id)->get();
              @endphp
            </div>
           
            <div class="card-body height3">
              <div class="media">
                <div class="media-body">
                  <div class="ul chat-list">
                          @foreach ($messages as $msg)
                          <div class="media">
                             <div class="d-flex flex-column mark-controls">

                              @if(is_null($msg->corruption_related_id))
                              <a href="" title="Click to mark as corruption related" 
                                 class="mt-2 {{ Auth::guest() ? 'off' : ''}}"
                                    onclick="event.preventDefault(); document.getElementById('Corr-related-{{ $msg->id }}').submit();">
                              <i class="fas fa-check-circle fa-2x mb-2"></i> 
                              </a>
                              <form id="Corr-related-{{ $msg->id }}" action="/messages/{{ $msg->id }}/corruptionRelated" method="POST" style="disp:none;">
                                    @csrf
                              </form>
                                @else
                                <a title="This message is marked as corruption related" class="mt-2 related">
                                   <i class="fas fa-check-circle fa-2x mb-2"></i> 
                                 </a>
                                 @endif

                                <div class="dropdown mt-1">
                                <a title="Choose action" class="dropdown-toggle mark-action dropbtn"  aria-expanded="false">
                                     <i class="fas fa-bars fa-2x"></i>
                                </a>
                                <div class="dropdown-menu dropdown-content">
                                  <h6 class="dropdown-header">Choose action</h6>                      
                                  <a href="#">Tagging</a> 
                                </div>
                                </div>
                              
                              </div>
                            <div class="media-body">
                              <div class="li in">
                                {{--  
                                <div class="chat-img ">
                                  <img alt="Avtar" src="http://bootdey.com/img/Content/avatar/avatar1.png">
                                </div>
                                --}}
                                <div class="chat-body mt-2">
                                  <div class="chat-message ">
                                    <h5 class="text-muted">  {{ $msg->msisdn}}</h5>
                                    <p>{{ $msg->body }}</p>
                                    <small class="float-right text-muted">{{ $msg->created_date }}</small>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          @if($msg->replies_count > 0)
                          @foreach ($msg->replies as $reply)
                          
                          <div class="media">
                            <div class="media-body">
                              <div class="li out">
                               <div class="chat-img">
                                  <img alt="Avtar" src="http://bootdey.com/img/Content/avatar/avatar6.png">
                               </div>
                               <div class="chat-body mt-2">
                               <div class="chat-message float-right">
                                <p>{{ $reply->body }}</p>
                                <div class="float-right mt-0 ">
                                  <span class="text-primary"> <small> By {{$reply->user->name  }}</small></span>
                                  <div class="media">
                                      <span class="text-muted"> <small>On {{ $reply->created_date}}</small> </span>
                                  </div>
                                </div>
                                </div>

                                </div>
                               </div>
                            </div>
                          </div>
                          @endforeach
                          @endif

                      @endforeach
              
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
    </div>
    @include('replies._create')
</div>
@endsection

