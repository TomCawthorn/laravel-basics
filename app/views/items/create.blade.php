@extends('layouts.main')
@section('content')

	<div class="large-12 columns">

		<h2>Add to {{ $list->name }}</h2>
		<p>{{ link_to_route('todos.show', 'Back', $list->id) }}</p>

		{{ Form::open( [ 'route' => ['todos.items.store', $list->id ] ] ) }}
			@include('items.partials._form')
		{{ Form::close() }}

	</div>
	
@stop