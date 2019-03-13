
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
             <div class="card-body ">
                 <div class="card-title">
                  <div class="d-flex align-items-center">
                    
                    <h2>{{ $messages->first()->phone->messages_unread_count . " New " . str_plural('message', $messages->first()->phone->messages_unread_count). " from " . $msisdn }}</h2>
                  <div class="ml-auto">
                    <a href="{{route('messages.index')}}"  class="btn btn-outline-secondary"> Back to all Messages</a>
                  </div>
                 </div>
                </div>
                <hr>
                @include('layouts._messages')

                <div class="media">
                  
                  <div class="media-body ">
                      @foreach ($messages as $msg)
                      <div class="media">
                        <div class="d-flex flex-column mark-controls">
                           <a title="Mark this message as corruption related" class="mark-related off">
                             <i class="fas fa-check-circle fa-2x mb-2"></i>
                           </a>
                           <a title="Choose action" class="mark-action">
                             <i class="fas fa-bars fa-2x"></i>
                           </a>
                    
                        </div>

                        <div class="media-body">

                         <h3 class="mt-0">
                        {{ $msg->msisdn }}
                          <div class="float-right">
                          <h6><span class="badge badge-secondary">New</span></h6>
                          </div>
                          </h3>
                          <div class="lead">
                          <small class="text-muted"> {{ $msg->created_date }}</small>
                          </div>
                           <div class="msg-container">
                             {{ $msg->body }}
                           </div>
                        </div>

                        </div>
                        <hr>
                        @endforeach

                  </div>
                    
                </div>
             </div>
            </div>
        </div>
    </div>
    @include('replies._create')
</div>
@endsection
