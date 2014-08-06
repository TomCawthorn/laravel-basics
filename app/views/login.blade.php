@extends('master')
 
@section('content')
{{Form::open(array('url'=>'/login','method'=>'post'))}}</pre>
<h1>Login Form</h1>
<div><input id="username" type="text" name="identity" placeholder="Username/Email" required="" value="{{Input::old('identity')}}" /></div>
<div><input id="password" type="password" name="password" placeholder="Password" required="" /></div>
<div><input type="submit" value="Log in" />
 <a href="/forgotpassword">Lost your password?</a>
 <a href="/register">Register</a></div>
<pre>
{{Form::close()}}
 
@stop