<?php
class TodoList extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'todo_lists';


	public function listItems()
	{
		return $this->hasMany('TodoItem');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}

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


	public function get_list_status() 
	{
		$total = $this->total_item_count();		
		$completed = $this->completed_item_count();

		if ($this->has_completed_items()) {
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
			$str = "This list has no items. " . link_to_route('todos.items.create', 'Add Item', [$this->id]);
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