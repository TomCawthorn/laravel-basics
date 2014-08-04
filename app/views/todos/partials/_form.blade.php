		{{ Form::label('name', 'List Title') }}
		{{ Form::input('text', 'name') }}		
		{{ $errors->first('name', '<small class="error">:message</small>') }}	
		{{ Form::submit('Save', array('class' => 'button')) }}