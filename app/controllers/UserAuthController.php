<?php

class UserAuthController extends \BaseController {



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('user_auth.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$attributes = [ 'email' => Input::get('email'), 'password' => Input::get('password') ];
		$remember_me = Input::get('remember_me');
		if (Auth::attempt($attributes, $remember_me))
		{
		    return Redirect::intended('/');
		} else {
  			return Redirect::route('login')->withInput();
		}	
	}



	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		Auth::logout();
		return Redirect::route('login');
	}


}
