@extends('layouts.main')
@section('content')

	<div class="large-12 columns">

		<h2>{{{ $list->name }}}</h2>	

		<p>{{ link_to_route('todos.index', 'Back') }}</p>

		@foreach ($items as $item)
			@include('items.partials._item')
		@endforeach

		{{ link_to_route('todos.items.create', 'Add Item', [$list->id], ['class' =>'button']) }}

	</div>

@stop