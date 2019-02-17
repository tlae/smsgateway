
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All Messages</div>

                <div class="card-body">
                	@foreach ($messages as $message)
                	<div class="media">
                		<div class="media-body">
                			<h3 class="mt-0">
                				<a href="{{ $message->url }}">{{ $message->msisdn }}</a>
                			</h3>
                			 <div class="lead">
                			 	<small class="text-muted"> {{ $message->created_date }}</small>
                			 	@if($message->unread_count > 0)
                			 	<span class="badge badge-primary badge-pill ml-3">{{ $message->unread_count }}</span>
                			 	@endif
                			 </div>
                			{{ str_limit($message->body, $limit = 200, $end = '...') }}
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
