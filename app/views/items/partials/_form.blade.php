		{{ Form::label('content', 'Item') }}
		{{ Form::input('text', 'content') }}		
		{{ $errors->first('content', '<small class="error">:message</small>') }}	
		{{ Form::submit('Add', array('class' => 'button')) }}