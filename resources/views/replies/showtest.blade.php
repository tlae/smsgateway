@extends('layouts.app')
@section('content')
<div class="container content">
    <div class="row">
        <div class="col-sm">
          <div class="card">
            <div class="card-header"> 
              @php
              $user = App\Msisdn::find($msisdn);
              $open_chat_id = $user->open_chat_id;
              if(is_null($open_chat_id)) {
                $has_open_chat = false;
              } 
              else {
                $has_open_chat = true;
                $chat = App\Chat::find($open_chat_id);
              }
              @endphp
              <div class="d-flex align-items-center">
                   <h2>{{ "Messages for" . " " . $msisdn }}</h2> 
                   @if ($has_open_chat)
                   <div class="ml-5">
                     <h2><a tabindex="0" role="button" id ="chatpopover" data-container="body"  data-html="true" type="button" class="btn btn-lg btn-primary waves-effect waves-light" data-toggle="popover" data-placement="bottom">Unclosed conversation</a></h2>
                   </div>
                   <div id="popover-content-chatpopover" class="d-none">
                       <div class="title">
                        <h5>{{$chat->title}}</h5> 
                        <a  type="button" class="btn btn-outline-primary btn-lg" href="/chats/{{$chat->slug}}" >Go to chat</a>
                       </div>  
                    </div>
                    @endif
                   <div class="ml-auto">
                      <a href="{{route('messages.index')}}" title="Back to all Messages"> 
                         <i class="fas fa-undo-alt fa-2x"></i>
                      </a>
                   </div>
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

                              @if(is_null($msg->corruption_related_id) && is_null($msg->misuse_id) )

                              <a href="" title="Click to mark as corruption related" 
                                 class="mt-2 {{ Auth::guest() ? 'off' : ''}}"
                                    onclick="event.preventDefault(); document.getElementById('Corr-related-{{ $msg->id}}').submit();">
                              <i class="fas fa-check-circle fa-2x mb-2 mr-2"></i> 
                              </a>
                              <form id="Corr-related-{{ $msg->id }}" action="/messages/{{ $msg->id }}/corruptionRelated" method="POST" style="disp:none;">
                                    @csrf
                              </form>
                                @elseif(is_null($msg->corruption_related_id))
                                    <a title="This message is marked as {{ $msg->misuse->category}} " class="mt-2 {{ $msg->misuse->category}}">
                                      <i class="fas fa-exclamation-triangle fa-2x mb-2 mr-2"></i>
                                    </a>
                                @else 
                                    <a title="This message is marked as corruption related" class="mt-2 related">
                                      <i class="fas fa-check-circle fa-2x mb-2 mr-2"></i> 
                                    </a>
                                @endif

                                <div class="dropdown mt-1">
                                <a title="Choose action" class="dropdown-toggle mark-action dropbtn"  aria-expanded="false">
                                     <i class="fas fa-bars fa-2x"></i>
                                </a>
                                <div class="dropdown-menu dropdown-content">
                                  {{-- <a href="{{ route('messages.chat.create', $msg->id)  }}">Create new chat</a> --}}
                                  @if ($has_open_chat)
                                  <a href="/chats/{{$chat->slug}}">Go to chat</a>
                                  @else
                                  <a class= "chatmodal" data-toggle="modal" href="#chatModal{{ $msg->id }}"  id="{{ $msg->id }}" data-id="chatModal{{ $msg->id }}"> Create new chat</a> 
                                  @endif                       
                                  <a href="#">Tagging</a>
                                  
                                    @if(is_null($msg->corruption_related_id) && is_null($msg->misuse_id) )
                                      <div class="dropdown-divider"></div>

                                      <span class="ml-2">Misuse&Abuse</span>

                                      <a href="" title="" 
                                          class="mt-2 {{ Auth::guest() ? 'off' : ''}} misuses"
                                          onclick="event.preventDefault(); document.getElementById('misuse-{{ $msg->id }}').submit();">
                                          <i class="far fa-thumbs-down fa-1x mb-2 align-middle"></i> Mark as misuse
                                      </a>
                                      <a href="" title="" 
                                          class="mt-2 {{ Auth::guest() ? 'off' : ''}} align-text-bottom abuses"
                                          onclick="event.preventDefault(); document.getElementById('abuse-{{ $msg->id }}').submit();">
                                          <i class="far fa-thumbs-down fa-1x mb-2 align-middle"></i> Mark as Abuse
                                      </a> 
                                          <form id="misuse-{{ $msg->id }}" action="/messages/{{ $msg->id }}/misuse" method="POST" style="disp:none;">
                                              <input type="hidden" name="category" value="misuse">
                                              @csrf
                                          </form>
                                          <form id="abuse-{{ $msg->id }}" action="/messages/{{ $msg->id }}/misuse" method="POST" style="disp:none;">
                                              <input type="hidden" name="category" value="abuse">
                                              @csrf
                                          </form>  
                                    @endif                     
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

     $("[data-toggle=popover]").each(function(i, obj) {

      $(this).popover({
        html: true,
        content: function() {
          var id = $(this).attr('id')
          return $('#popover-content-' + id).html();
        }
      });

      });
    </script>
@endsection
