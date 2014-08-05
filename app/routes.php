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
Useful
 Event::listen('illuminate.query', function($query){
 	var_dump($query);
 });
Route::get('/todos', 'TodoListController@index');
Route::get('/todos/{id}', 'TodoListController@show');
*/

Route::get('/', 'TodoListController@index');

Route::get('/db', function() {
	$result = DB::table('todo_lists')->where('name', 'Your List')->first();
	return $result->name;
});

Route::resource('todos', 'TodoListController');

Route::resource('todos.items', 'TodoItemController', array('except' => array('index', 'show')));

Route::get('/todos/{list_id}/items/{item_id}/completed', [ 'as' => 'todos.items.completed', 'uses' => 'TodoItemController@completed'] );

