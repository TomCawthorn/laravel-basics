@extends('layouts.main')
@section('content')

	<div class="large-12 columns">

		<h2>Edit Todo List</h2>

		<p>{{ link_to_route('todos.index', 'Back') }}</p>

		{{ Form::model( $list, array('route' => ['todos.update', $list->id], 'method' => 'put') ) }}
			@include('todos.partials._form')
		{{ Form::close() }}

	</div>

@stop