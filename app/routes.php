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

/*
|  Todo Lists
|---------------
*/

Route::get('/', 'TodoListController@index');
Route::resource('todos', 'TodoListController');

/*
|  Todo Items
|---------------
*/

Route::get('/todos/{list_id}/items/{item_id}/completed', [ 'as' => 'todos.items.completed', 'uses' => 'TodoItemController@completed'] );
Route::resource('todos.items', 'TodoItemController', ['except' => array('index', 'show') ] );

/*
|  Users
|---------------
*/

Route::resource('users', 'UserController');


