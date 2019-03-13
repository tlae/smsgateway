
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2> All Messages</h2>
                        <div class="ml-auto">
                            <a href="{{ route('messages.create') }}" class="btn btn-outline-secondary"> Create message</a>
                        </div>
                    </div>
                   
                </div>
               
                <div class="card-body">
                     @include('layouts._messages')
                	@foreach ($messages as $message)

                	<div class="media">
                        <div class="d-flex flex-column counters">
                            <div class="sms">
                                <i title="Total SMS from user" class="fas fa-comment-medical fa-2x mr-1"></i>
                                <small class="text-inf"> {{ $message->phone->messages_count }} </small>
                            </div>
                            <div class="status very">
                                <i title="Corruption related SMS" class="fas fa-check-circle fa-2x mr-1"></i>
                                <small class="text-muted"> {{ $message->phone->corruption_related_count }}</small>
                            </div>
                            <div class="chat">
                                <i title="Chats with user" class="far fa-comments fa-2x mr-1"></i>
                                <small class="text-muted"> {{ $message->phone->chats_count }}</small>
                            </div>
                        </div>

                		<div class="media-body">
                			<h3 class="mt-0">
                				<a href="{{ $message->url }}">{{ $message->msisdn }}</a>
                			</h3>
                			 <div class="lead">
                			 	<small class="text-muted"> {{ $message->created_date }}</small>
                			 	@if($message->phone->messages_unread_count > 0)
                			 	<span class="badge badge-primary badge-pill ml-3">{{ $message->phone->messages_unread_count }}</span>
                                @else
                                @if($message->phone->last_message_replied)
                                <div class="replied float-right">
                                    <small><i class="fas fa-reply"></i></small>
                                </div>
                                @endif
                			 	@endif
                			 </div>
                			{{ str_limit($message->body, $limit = 260, $end = '...') }}
                		</div>
                	</div>
                	<hr>

                	@endforeach


                	{{ $messages->links() }}
                    

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
