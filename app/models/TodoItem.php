<?php
class TodoItem extends Eloquent {

	protected $fillable = ['content'];

	public function todoList()
	{
		return $this->belongsTo('TodoList');
	}

}