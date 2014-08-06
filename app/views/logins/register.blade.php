@extends('layouts.main')
 
@section('content')
 
{{Form::open(array('url'=>'/register','method'=>'post'))}}</pre>
<h1>Register</h1>
<div><input id="username" type="text" name="email" placeholder="Enter Email" required="" value="{{Input::old('email')}}" /></div>
<div><input id="username" type="text" name="username" placeholder="Enter Username" required="" value="{{Input::old('username')}}" /></div>
<div><input id="password" type="password" name="password" placeholder="Enter Password" required="" /></div>
<div><input id="password" type="password" name="password_confirmation" placeholder="Confirm Password" required="" /></div>
<div><input type="submit" value="Register" />
 <a href="/forgotpassword">Forgot password?</a>
 <a href="/login">Login</a></div>
<pre>
{{Form::close()}}
 
@stop