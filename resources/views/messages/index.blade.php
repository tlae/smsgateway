
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
                			<h3 class="mt-0">{{ $message->msisdn }}</h3>
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
