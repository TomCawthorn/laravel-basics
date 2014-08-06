@extends('layouts.main')
 
@section('content')

	<div class="large-12 columns">

		<h2>Register</h2>
		 
		{{ Form::open(array('route'=>'users.register','method'=>'post')) }}</pre>
			@include('users.partials._form')
		{{ Form::close() }}

		<br>

		{{ link_to_route('forgotpassword', 'Forgot password?') }}
		{{ link_to_route('login', 'Login') }}

	</div>
 
@stop