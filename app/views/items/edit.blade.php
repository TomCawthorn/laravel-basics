@extends('layouts.main')
@section('content')

	<div class="large-12 columns">
	
		<h2>Edit Item in {{{ $list->name }}}</h2>
		
		<p>{{ link_to_route('todos.show', 'Back', $list->id) }}</p>

		{{ Form::model( $item, array('route' => ['todos.items.update',  $list->id, $item->id ] , 'method' => 'put') ) }}
			@include('items.partials._form')
		{{ Form::close() }}


		{{ Form::model( $item, array('route' => ['todos.items.destroy', $list->id, $item->id], 'method' => 'delete') ) }}
			{{ Form::button('Delete', ['type' => 'submit', 'class' => 'tiny button alert']) }}
		{{ Form::close() }}

	</div>

@stop