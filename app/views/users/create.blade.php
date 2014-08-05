@extends('layouts.main')
@section('content')

	<div class="large-12 columns">

		<h2>Users: create</h2>

		{{ Form::open( ['route' => 'users.store'] ) }}
			@include('users.partials._form')
		{{ Form::close() }}

	</div>

@stop