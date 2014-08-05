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


	public function completed_item_count() 
	{
		return $this->listItems()->completed()->count();
	}


	public function total_item_count() 
	{
		return $this->listItems()->count(); 
	}


	public function listItems()
	{
		return $this->hasMany('TodoItem');
	}



	public function get_list_status($list_id) 
	{
		$list = TodoList::findOrFail($list_id);
		$total = $list->total_item_count();		
		$completed = $list->completed_item_count();

		if ($list->has_completed_items()) {
			if ($total === $completed) {
				$str = "You have completed all the items in this list. Great job!";
			} else {
				$str = "You have completed $completed out of $total " . $this->plural_singular($total) . "." ;
			}
		} elseif (!$this->has_completed_items() && $total > 0) {
			if ($total === 0) {
				$total = "no";
			}
			$str = "You have $total " . $this->plural_singular($total) . " to complete.";
		} else {
			$str = "This list has no items.";
		}
		return $str;
	}


	public function plural_singular($count) 
	{
		if ($count === 1) {
			return "item";
		} else {
			return "items";
		}
	}	


}