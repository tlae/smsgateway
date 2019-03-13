
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2> New test message</h2>
                        <div class="ml-auto">
                            <a href="{{ route('messages.index') }}" class="btn btn-outline-secondary"> Back to all messages</a>
                        </div>
                    </div>
                   
                </div>

                <div class="card-body">
                	
                    <form action=" {{ route('messages.store') }} " method="post">
                        @csrf
                        <div class="form-group">
                            <label for="message-msisdn">MSISDN</label>
                            <input type="text" name="msisdn" id="message-msisdn" class="form-control {{ $errors->has('msisdn') ? 'is-invalid' : '' }}" >
                            @if ($errors->has('msisdn'))
                                <div class="invalid-feedback"><strong>{{ $errors->first('msisdn') }}</strong></div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="message-body"> Message</label>
                            <textarea name="body" id="message-body"  rows="7" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"></textarea>
                                @if ($errors->has('body'))
                                <div class="invalid-feedback"><strong>{{ $errors->first('body') }}</strong></div>
                                @endif
                        </div>
                        <div class="form-group">
                         <button type="submit" class="btn btn-outline-primary btn-lg">Send message</button>  
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
