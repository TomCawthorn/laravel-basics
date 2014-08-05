<?php
class TodoList extends Eloquent {


	public function has_completed_items($list_id){
		$items = TodoItem::completed($list_id)->orderBy('created_at')->get();
		if ($items->count() > 0) {
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