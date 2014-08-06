{{ Form::label('first_name', 'First Name', ['class' => 'hide']) }}
{{ Form::text('first_name', null, ['placeholder' => 'First name']) }}
{{ $errors->first('first_name', '<small class="error">:message</small>') }}

{{ Form::label('last_name', 'Last Name', ['class' => 'hide']) }}
{{ Form::text('last_name', null, ['placeholder' => 'Last Name']) }}
{{ $errors->first('last_name', '<small class="error">:message</small>') }}

{{ Form::label('email', 'Email', ['class' => 'hide']) }}
{{ Form::email('email', null, ['placeholder' => 'Email']) }}
{{ $errors->first('email', '<small class="error">:message</small>') }}

{{ Form::label('password', 'Password', ['class' => 'hide']) }}
{{ Form::password('password', ['placeholder' => 'Password']) }}
{{ $errors->first('password', '<small class="error">:message</small>') }}

{{ Form::label('password_confirmation', 'Password (again)', ['class' => 'hide']) }}
{{ Form::password('password_confirmation', ['placeholder' => 'Password (again)']) }}
{{ $errors->first('password_confirmation', '<small class="error">:message</small>') }}

{{ Form::submit('Register', ['class' => 'button']) }}
