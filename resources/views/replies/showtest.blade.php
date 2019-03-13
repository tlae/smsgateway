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
                                  {{-- <a href="{{ route('messages.chat.create', $msg->id)  }}">Open Chat</a> --}}
                                  <a class= "chatmodal" data-toggle="modal" href="#chatModal{{ $msg->id }}"  id="{{ $msg->id }}" data-id="chatModal{{ $msg->id }}"> Open Chat</a>                        
                                  <a href="#">Tagging</a>                                  
                                  <a href="#">Abuse & Misuse</a>
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
                                    <h5 class="text-muted">  {{ $msg->msisdn . "|" . $msg->id }}</h5>
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
                                <small>
                                <div class="float-right text-muted"> {{ " " . $reply->created_date }}</div>
                                <div class="text-primary float-right">{{ "By " . $reply->user->name . ".."}}</div>
                                </small>
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
    @include('chats._chatcreate')

    <script>


    $(document).ready(function(){
      $(".chatmodal").click(function(){
        var thisid = $(this).attr("data-id");
         var myid = $(this).attr("id");
        $(".modal").attr("id",thisid);
        $("#chatForm").attr("action","{{ url('/messages') }}" + "/" + myid+ "/chat");
        $(thisid).modal('show');  
      });    
      });
        
    </script>
@endsection
