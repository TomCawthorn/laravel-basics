<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Cartalyst\Sentry\Users\Eloquent\User as SentryModel;

class User extends SentryModel {

	use UserTrait, RemindableTrait;
	protected $fillable = ['first_name', 'last_name', 'email', 'password'];	

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';


	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');


	/**
	 * Related Todolist models
	 *
	 * @var array
	 */
	public function todoLists()
	{
		return $this->hasMany('TodoList');
	}

}
