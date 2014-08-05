@extends('layouts.main')
@section('content')

	<div class="large-12 columns">

		<h2>Users: Login</h2>

		{{ Form::open( ['route' => 'user_auth.store'] ) }}
			{{ Form::label('email', 'Email') }}
			{{ Form::input('email', 'email') }}

			{{ Form::label('password', 'Password') }}
			{{ Form::input('password', 'password') }}

			{{ Form::label('remember_me') }}
			{{ Form::checkbox('remember_me') }}
			<br>
			{{ Form::submit('Log in', ['class' => 'button']) }}
		{{ Form::close() }}

	</div>

@stop