{{ Form::label('first_name', 'First Name') }}
{{ Form::input('text', 'first_name') }}
{{ $errors->first('first_name', '<small class="error">:message</small>') }}

{{ Form::label('last_name', 'Last Name') }}
{{ Form::input('text', 'last_name') }}
{{ $errors->first('last_name', '<small class="error">:message</small>') }}

{{ Form::label('email', 'Email') }}
{{ Form::input('email', 'email') }}
{{ $errors->first('email', '<small class="error">:message</small>') }}

{{ Form::label('password', 'Password') }}
{{ Form::input('password', 'password') }}
{{ $errors->first('password', '<small class="error">:message</small>') }}

{{ Form::label('password_confirmation', 'Password (again)') }}
{{ Form::input('password', 'password_confirmation') }}
{{ $errors->first('password_confirmation', '<small class="error">:message</small>') }}

{{ Form::submit('Submit', ['class' => 'button']) }}