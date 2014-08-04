@extends('layouts.main')
@section('content')
	@if (isset($data['last_name']))
		{{{ $data['last_name'] }}}
		<br>
	@else
		no last name set
		<br>
	@endif
	<ul>
	@foreach ($data as $item)
		<li>{{{ $item }}}</li>
	@endforeach
	</ul>
@stop