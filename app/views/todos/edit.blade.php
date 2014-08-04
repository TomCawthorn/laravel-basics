@extends('layouts.main')
@section('content')
	{{ Form::model( $list, array('route' => ['todos.update', $list->id], 'method' => 'put') ) }}
		@include('todos.partials._form')
	{{ Form::close() }}
@stop