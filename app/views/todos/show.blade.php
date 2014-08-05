@extends('layouts.main')
@section('content')
	<div class="large-12 columns">
		<p>{{ link_to_route('todos.index', 'Back') }}</p>
		<h1>{{{ $list->name }}}</h1>

		@foreach ($items as $item)
			@if (!$item->is_item_completed()) 
				<h2>{{ link_to_route('todos.items.completed', "Mark Complete",[$list->id, $item->id]) }}</h2>
			@else
				<h2>{{ link_to_route('todos.items.completed', "Item Complete",[$list->id, $item->id]) }}</h2>
			@endif

			<h4>{{ link_to_route('todos.items.edit', $item->content, [$list->id, $item->id]) }}</h4>
			<hr>
		@endforeach

		{{ link_to_route('todos.items.create', 'Add Item', [$list->id], ['class' =>'button']) }}

	</div>
@stop