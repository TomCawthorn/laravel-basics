@extends('layouts.main')
@section('content')

	<div class="large-12 columns">

		<h2>Users: create</h2>

		{{ Form::open( ['route' => 'users.store'] ) }}
			{{ Form::label('first_name', 'First Name') }}
			{{ Form::input('text', 'first_name') }}

			{{ Form::label('last_name', 'Last Name') }}
			{{ Form::input('text', 'last_name') }}

			{{ Form::label('email', 'Email') }}
			{{ Form::input('email', 'email') }}

			{{ Form::label('password', 'Password') }}
			{{ Form::input('password', 'password') }}

			{{ Form::label('password_confirm', 'Password (again)') }}
			{{ Form::input('password', 'password_confirm') }}

			{{ Form::submit('Submit', ['class' => 'button']) }}

		{{ Form::close() }}

	</div>

@stop