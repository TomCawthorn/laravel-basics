@extends('master')
 
@section('content')
{{Form::open(array('url'=>'/newpassword','method'=>'post'))}}</pre>
<h1>New Password</h1>
<pre>
<input type="hidden" name="email" value="{{Input::get('email')}}" />
<input type="hidden" name="resetcode" value="{{Input::get('resetcode')}}" /></pre>
<div><input id="password" type="password" name="password" placeholder="New Password" required="" /></div>
<div><input id="password" type="password" name="password_confirmation" placeholder="Confirm Password" required="" /></div>
<div><input type="submit" value="Save" />
 <a href="/register">Register</a>
 <a href="/login">Login</a></div>
<pre>
{{Form::close()}}
@stop