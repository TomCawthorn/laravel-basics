<?php
class LoginController extends BaseController {
 



    public function __construct() {
        //We will implement Filters later
        $this -> beforeFilter('csrf', array('on' => 'post'));
    }
     



    //Log User Out
    public function getLogout() 
    {
        Sentry::logout();
        return Redirect::to('/login');
     }




    /*
    Instead directing to TodoController@index
    	public function dashboard(){
    	return View::make('index');
    }
    */
     



    //Show login Form
    public function showLogin() {
        return View::make('user_auth.login');
    }



     
    //Authenticate User
    public function storeLogin() 
    {
        //First let's start by making sure the input isn't something rediculous.
        $inputs = array('email' => Input::get('email'), 'password' => Input::get('password'));
        //$rules are purposefully thin to avoid giving maliscuous attackers any extra information.
        $rules = array('email' => 'required|email', 'password' => 'required');

        if (!filter_var(Input::get('email'), FILTER_VALIDATE_EMAIL)) {
            Session::flash('error_msg', 'Invalid Email or Password');
            return Redirect::to('login') -> withInput(Input::except('password'));
        }
        $v = Validator::make($inputs, $rules);
        if ($v -> fails()) {
            return Redirect::to('login') -> withErrors($v) -> withInput(Input::except('password'));
        } else {
            try {
                //Try to authenticate user
                $user = Sentry::getUserProvider() -> findByLogin(Input::get('email'));
 
                $throttle = Sentry::getThrottleProvider() -> findByUserId($user -> id);
 
                $throttle -> check();
 
                //Authenticate user
                $credentials = array('email' => Input::get('email'), 'password' => Input::get('password'));
 
                //For now auto activate users
                $user = Sentry::authenticate($credentials, false);
 
                //At this point we may get many exceptions lets handle all user management and throttle exceptions
            } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
                Session::flash('error_msg', 'Login field is required.');
                return Redirect::to('/login');
            } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
                Session::flash('error_msg', 'Password field is required.');
                return Redirect::to('/login');
            } catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
                Session::flash('error_msg', 'Invalid Email or Password.');
                return Redirect::to('/login');
            } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
                Session::flash('error_msg', 'Invalid Email or Password.');
                return Redirect::to('/login');
            } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
                Session::flash('error_msg', 'Invalid Email or Password.');
                return Redirect::to('/login');
            } catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
                Session::flash('error_msg', 'Invalid Email or Password.');
                return Redirect::to('/login');
            } catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
                Session::flash('error_msg', 'Invalid Email or Password.');
                return Redirect::to('/login');
            }
 
            Session::flash('success_msg', 'Hey ' . $user->first_name . '!');
            return Redirect::to('/');
 
        } 
    }
   



    //Show forgotpassword Form
    public function showForgotpassword() 
    {
        return View::make('user_auth.forgotpassword');
    }
 



    //Send email for forgot password
    public function storeForgotpassword() {
        if (Input::has('email')) {
 
            $email = Input::get('email');
 
            try {
                // Find the user using the user email address
                $user = Sentry::findUserByLogin($email);
 
                // Get the password reset code
                $resetCode = $user -> getResetPasswordCode();
 
 				//TESTING ONLY
                //Log::info('Reset code:' . $resetCode);

                Mail::send("emails.resetpassword", array("email" => $email, "resetCode" => $resetCode), function($message) use ($email, $resetCode) {
                    $message -> to($email) -> subject('Follow the link to reset your password');
                });
 
                Session::flash('success_msg', 'We have sent a link to your email account please follow that to reset your password');
                return Redirect::to('/forgotpassword');
 
                // Now you can send this code to your user via email for example.
            } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
                Session::flash('error_msg', 'User not found');
                return Redirect::to('/forgotpassword');
            }
        } else {
            Session::flash('error_msg', 'User not found');
            return Redirect::to('/forgotpassword');
        }
    }
 



    //Show newpassword Form
    public function showNewPassword() 
    {
        if (Input::has('email') && Input::has('resetcode')) {
 
            try {
                // Find the user using the user id
                $user = Sentry::findUserByLogin(Input::get('email'));
 
                // Check if the reset password code is valid
                if ($user -> checkResetPasswordCode(Input::get('resetcode'))) {
                    return View::make('newpassword');
 
                } else {
                    Session::flash('error_msg', 'Invalid request . Please enter email to reset your password');
                    return Redirect::to('/forgotpassword');
                }
            } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
                Session::flash('error_msg', 'User not found');
                return Redirect::to('/forgotpassword');
            }
        } else {
            Session::flash('error_msg', 'Invalid request . Please enter email to reset your password');
            return Redirect::to('/forgotpassword');
        }
    }
     



    //Store new password
    public function storeNewPassword() 
    {
        //Validator to check password ,password confirmation
        $input = array('password' => Input::get('password'), 'password_confirmation' => Input::get('password_confirmation'));
 
        $rules = array('password' => 'required|min:4|max:32|confirmed', 'password_confirmation' => 'required|min:4|max:32');
 
        $v = Validator::make($input, $rules);
 
        if ($v -> passes()) {
            if (Input::has('email') && Input::has('resetcode')) {
 
                try {
                    // Find the user using the user id
                    $user = Sentry::findUserByLogin(Input::get('email'));
 
                    // Check if the reset password code is valid
                    if ($user -> checkResetPasswordCode(Input::get('resetcode'))) {
                        // Attempt to reset the user password
                        if ($user -> attemptResetPassword(Input::get('resetcode'), Input::get('password'))) {
                            Session::flash('success_msg', 'Password changed successfully . Please login below');
                            return Redirect::to('/login');
                        } else {
                            Session::flash('error_msg', 'Unable to reset password . Please try again');
                            return Redirect::to('/forgotpassword');
                        }
                    } else {
                        Session::flash('error_msg', 'Unable to reset password . Please try again');
                        return Redirect::to('/forgotpassword');
                    }
                } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
                    Session::flash('error_msg', 'User not found');
                    return Redirect::to('/forgotpassword');
                }
            } else {
                Session::flash('error_msg', 'Invalid request . Please enter email to reset your password');
                return Redirect::to('/forgotpassword');
            }
        } else {
            return Redirect::to('/newpassword?email=' . Input::get('email') . '&resetcode=' . Input::get('resetcode')) -> withErrors($v) -> withInput();
        }
    }

 




}