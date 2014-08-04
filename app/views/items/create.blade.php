@extends('layouts.main')
@section('content')
	<div class="large-12 columns">
		<h2>Add to {{ $list->name }}</h2>

	{{ Form::open( [ 'route' => ['todos.items.store', $list->id ] ] ) }}
		@include('items.partials._form')
	{{ Form::close() }}

	</div>
@stop