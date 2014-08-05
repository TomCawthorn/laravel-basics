<?php
class TodoItem extends Eloquent {

	protected $fillable = ['content'];

	public function todoList()
	{
		return $this->belongsTo('TodoList');
	}

	public function toggle_completed()
	{
		if ($this->completed_on == "") {
			$this->compelted_on = time();
		} else {
			$this->completed_on = "";
		}
	}

}