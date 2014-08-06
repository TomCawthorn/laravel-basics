<?php
class LoginController extends BaseController {
 
public function __construct() {
//We will implement Filters later
$this -> beforeFilter('csrf', array('on' => 'post'));
}
 
public function dashboard(){
return View::make('index');
}
 
//Show login Form
public function showLogin() {
 
return View::make('login');
}
 
//Authenticate User
public function storeLogin() {
 
}
 
//Show register Form
public function showRegister() {
return View::make('register');
}
 
//Register User
public function storeRegister() {
 
}
 
//Show forgotpassword Form
public function showForgotpassword() {
return View::make('forgotpassword');
}
 
//Send email for forgot password
public function storeForgotpassword() {
 
}
 
//Show newpassword Form
public function showNewPassword() {
return View::make('newpassword');
}
 
//Store new password
public function storeNewPassword() {
 
}
 
}