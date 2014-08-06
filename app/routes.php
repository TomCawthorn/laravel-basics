<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


/*
|  Loggin In
|--------------
*/

//Logging in and out
Route::get('/login',[ 'as' => 'login', 'uses' => 'LoginController@showLogin']);
Route::post('/login',[ 'as' => 'login', 'uses' => 'LoginController@storeLogin']);
Route::get('/logout','LoginController@getLogout');

//Password Recovery
Route::get('/forgotpassword',[ 'as' => 'forgotpassword', 'uses' => 'LoginController@showForgotpassword']);
Route::post('/forgotpassword',[ 'as' => 'forgotpassword', 'uses' => 'LoginController@storeForgotpassword']);
Route::get('/newpassword','LoginController@showNewPassword');
Route::post('/newpassword','LoginController@storeNewPassword');


/*
|  Users
|---------------
*/

//Registration
Route::get('/register',[ 'as' => 'users.register', 'uses' => 'UserController@showRegister']); 
Route::post('/register',[ 'as' => 'users.register', 'uses' => 'UserController@storeRegister']);
//Route::get('/register/{userId}/activate/{activationCode}','LoginController@registerActivate');


Route::group(array('before' => 'members_auth'), function () {

	/*
	|  Index
	|---------------
	*/

	Route::get('/', ['as' => 'index' ,'uses' => 'TodoListController@index']);
	 

	/*
	|  Todo Lists
	|---------------
	*/

	//Route::get('/', 'TodoListController@index');
	Route::resource('todos', 'TodoListController');


	/*
	|  Todo Items
	|---------------
	*/

	Route::get('/todos/{list_id}/items/{item_id}/completed', [ 'as' => 'todos.items.completed', 'uses' => 'TodoItemController@completed'] );
	Route::resource('todos.items', 'TodoItemController', ['except' => array('index', 'show') ] );

});



