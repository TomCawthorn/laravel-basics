@extends('layouts.main')
@section('content')
	<h2>Edit Item in {{{ $list->name }}}</h2>
	{{ Form::model( $item, array('route' => ['todos.items.update',  $list->id, $item->id ] , 'method' => 'put') ) }}
		@include('items.partials._form')
	{{ Form::close() }}
@stop