@extends('layouts.main')
 
@section('content')
	
	<div class="large-12 columns">

		<h2>Login</h2>

		{{ Form::open( ['route' => 'login', 'method' => 'post'] ) }}
			{{ Form::label('email', 'Email', ['class' => 'hide'] ) }}
			{{ Form::email('email', null, ['placeholder' => 'Email'] ) }}

			{{ Form::label('password', 'Password', ['class' => 'hide']) }}
			{{ Form::password('password', ['placeholder' => 'Password']) }}

			{{ Form::label('remember_me') }}
			{{ Form::checkbox('remember_me') }}
			<br>
			{{ Form::submit('Log in', ['class' => 'button']) }}
			<br>
 			{{ link_to_route('forgotpassword', "Lost your password?") }} | 
 			{{ link_to_route('register', "Register") }}
		{{ Form::close() }}

	</div>
 
@stop