@extends('layouts.main')
 
@section('content')
{{Form::open(array('url'=>'/forgotpassword','method'=>'post'))}}</pre>
<h1>Forgot Password</h1>
<div><input id="username" type="text" name="email" placeholder="Enter email" required="" value="{{Input::old('email')}}" /></div>
<div><input style="width: 130px;" type="submit" value="Reset Password" />
 <a href="/register">Register</a>
 <a href="/login">Login</a></div>
<pre>
{{Form::close()}}
@stop