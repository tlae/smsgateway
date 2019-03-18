
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2> All Chats</h2>
                    </div>
                   
                </div>
               
                <div class="card-body">
                     @include('layouts._messages')
                	@foreach ($chats as $chat)

                	<div class="media">

                		<div class="media-body">
                			<h3 class="mt-0">
                				<a href="{{ $chat->url }}">{{ $chat->title }}</a>
                			</h3>
                			
                			{{ str_limit($chat->summary, $limit = 260, $end = '...') }}
                		</div>
                	</div>
                	<hr>

                	@endforeach


                	{{ $chats->links() }}
                    

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
