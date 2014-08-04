@extends('layouts.main')
@section('content')
	<div class="small-12 columns">
	<h2>All Todo Lists</h2>
	@foreach ($todo_lists as $list)
		<h4>{{ link_to_route('todos.show', $list->name, [$list->id]) }}</h4>
		<ul class="no-bullet button-group">
			<li>
				{{ link_to_route('todos.edit', 'edit', [$list->id], ['class' => 'tiny button']) }}
			</li>
			<li>
				{{ Form::model( $list, array('route' => ['todos.destroy', $list->id], 'method' => 'delete') ) }}
					{{ Form::button('destroy', ['type' => 'submit', 'class' => 'tiny button alert']) }}
				{{ Form::close() }}
			</li>
		</ul>
	@endforeach	
	{{ link_to_route('todos.create', 'Create New List', null, ['class' => 'success button']) }}
	</div>

@stop