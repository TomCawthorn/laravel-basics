<?php
class TodoList extends Eloquent {


	public function has_completed_items() 
	{
		if ($this->listItems()->completed()->count() > 0) {
			return true;
		} else {
			return false;
		}
	}



	public function listItems()
	{
		return $this->hasMany('TodoItem');
	}
}