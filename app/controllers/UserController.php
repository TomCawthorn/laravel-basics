<?php

class UserController extends \BaseController {




	public function __construct()
	{
		$this->beforeFilter('csrf', array('on' => ['post', 'put']));
	}




	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::all();
		return View::make('users.index')->with('users', $users);
	}




	//Show register Form
	public function showRegister() 
	{
		return View::make('users.register');
	}




	//Register User
	public function storeRegister() 
	{
        // Gather Sanitized Input
        $input = array('username' => Input::get('username'), 'email' => Input::get('email'), 'password' => Input::get('password'), 'password_confirmation' => Input::get('password_confirmation'));
 
        // Set Validation Rules
        $rules = array('username' => 'required|min:4|max:20|unique:profile,username', 'email' => 'required|min:4|max:32|email|unique:profile,email', 'password' => 'required|min:6|confirmed', 'password_confirmation' => 'required|same:password');
 
        //Run input validation
        $v = Validator::make($input, $rules);
 
        if ($v -> fails()) {
            return Redirect::to('register') -> withErrors($v) -> withInput(Input::except(array('password', 'password_confirmation')));
        } else {
 
            try {
                //Pre activate user
                $user = Sentry::register(array('email' => $input['email'], 'password' => $input['password']), true);
                //$user = Sentry::register(array('email' => $input['email'], 'password' => $input['password']));
 
                //Get the activation code & prep data for email
                $data['activationCode'] = $user -> GetActivationCode();
                $data['email'] = $input['email'];
                $data['userId'] = $user -> getId();
 
                //send email with link to activate.
                //Need to edit app/config/mail.php
                /*Mail::send('emails.register_confirm', $data, function($m) use ($data) {
                 $m -> to($data['email']) -> subject('Thanks for Registration - Support Team');
                 });*/
 
                //If no groups created then create new groups
                try {
                    $user_group = Sentry::findGroupById(1);
                } catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e) {
                    $this -> createGroup('users');
                    $this -> createGroup('admin');
                    $user_group = Sentry::findGroupById(1);
                }
 
                $user -> addGroup($user_group);
 
                $user = new Profile();
 
                $user -> user_id = $data['userId'];
                $user -> email = $data['email'];
                $user -> username = $input['username'];
                $user -> save();
 
                //success!
                Session::flash('success_msg', 'Thanks for sign up . Please activate your account by clicking activation link in your email');
                return Redirect::to('/register');
 
            } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
                Session::flash('error_msg', 'Username/Email Required.');
                return Redirect::to('/register') -> withErrors($v) -> withInput(Input::except(array('password', 'password_confirmation')));
            } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
                Session::flash('error_msg', 'User Already Exist.');
                return Redirect::to('/register') -> withErrors($v) -> withInput(Input::except(array('password', 'password_confirmation')));
            }
 
        }
    }




	public function registerActivate($userId, $activationCode) 
	{
	        try {
	            // Find the user using the user id
	            $user = Sentry::findUserById($userId);
	 
	            // Attempt to activate the user
	            if ($user -> attemptActivation($activationCode)) {
	                Session::flash('success_msg', 'User Activation Successfull Please login below.');
	                return Redirect::to('/login');
	            } else {
	                Session::flash('error_msg', 'Unable to activate user Try again later or contact Support Team.');
	                return Redirect::to('/register');
	            }
	        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
	            Session::flash('error_msg', 'User was not found.');
	            return Redirect::to('/register');
	        } catch (Cartalyst\Sentry\Users\UserAlreadyActivatedException $e) {
	            Session::flash('error_msg', 'User is already activated.');
	            return Redirect::to('/register');
	        }
	}




	//Create user groups 
	public function createGroup($groupName) 
	{
	    $input = array('newGroup' => $groupName);

	    // Set Validation Rules
	    $rules = array('newGroup' => 'required|min:4');

	    //Run input validation
	    $v = Validator::make($input, $rules);

	    if ($v -> fails()) {
	        return false;
	    } else {
	        try {
	            $group = Sentry::getGroupProvider() -> create(array('name' => $input['newGroup'], 'permissions' => array('admin' => Input::get('adminPermissions', 0), 'users' => Input::get('userPermissions', 0), ), ));

	            if ($group) {
	                return true;
	            } else {
	                return false;
	            }

	        } catch (Cartalyst\Sentry\Groups\NameRequiredException $e) {
	            return false;
	        } catch (Cartalyst\Sentry\Groups\GroupExistsException $e) {
	            return false;
	        }
	    }
	}

}
