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


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('users.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$rules = array(
			'first_name' => 'required|min:2',
			'last_name' => 'required|min:2',
			'email' => 'required|email|unique:users',
			'password' => 'required|confirmed',
			'password_confirmation' => 'required|same:password'
			);

		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			return Redirect::route('users.create')->withErrors($validator)->withInput();
		}

		$user = new User();
		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('last_name');
		$user->email = Input::get('email');
		$user->password = Input::get('password');
		$user->save();

		return Redirect::route('users.index')->withMessage('Item successfully added');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}



	public function login_page() {
		return View::make('user_sessions.new');
	}

}
