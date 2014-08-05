@extends('layouts.main')
@section('content')

	<div class="large-12 columns">

		<h2>New Todo List</h2>

		<p>{{ link_to_route('todos.index', 'Back') }}</p>

		{{ Form::open( ['route' => 'todos.store'] ) }}
			@include('todos.partials._form')
		{{ Form::close() }}

	</div>

@stop