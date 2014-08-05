@extends('layouts.main')
@section('content')

	<div class="large-12 columns">

		<h2>Users: index</h2>

		@foreach ($users as $user)
			{{{ $user->first_name . " " . $user->last_name }}}
			<br>
			{{{ $user->email }}}
			<br>
			{{{ $user->password }}}
			<br>
			{{{ $user->remember_token }}}
			<hr>
		@endforeach

	</div>

@stop