{{ Form::label('content', 'Item') }}
{{ Form::input('text', 'content') }}		
{{ $errors->first('content', '<small class="error">:message</small>') }}	
{{ Form::submit('Save', array('class' => 'button')) }}