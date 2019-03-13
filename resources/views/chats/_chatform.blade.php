    <div class="form-group">
      <strong><label for="chat-title">Chat Tittle </label></strong>
      <input type="text" name="title" value="{{ old('title', $chat->title) }}" id="chat-title" class=" form-control {{ $errors->has('title') ? 'is-invalid' : '' }}">

      @if ($errors->has('title'))
           <div class="invalid-feedback">
            <strong>{{ $errors->first('title') }}</strong>
          </div>
       @endif
    </div>
    <div class="form-group">
      <strong><label for="chat-summary">Executive summary</label></strong>
      <textarea name="summary" id="chat-summary" rows="7" class="form-control {{ $errors->has('summary') ? 'is-invalid' : '' }}">{{ old('summary', $chat->summary) }}</textarea>

      @if ($errors->has('summary'))
         <div class="invalid-feedback">
           <strong>{{ $errors->first('summary') }}</strong>
         </div>
       @endif
    </div>
        
