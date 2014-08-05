@extends('layouts.main')
@section('content')
	<div class="small-12 columns">

		<h2>All Todo Lists</h2>

		@foreach ($todo_lists as $list)
			@include('todos.partials._todo')
		@endforeach	

		{{ link_to_route('todos.create', 'Create New List', null, ['class' => 'success button']) }}		

	</div>

@stop