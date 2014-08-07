<?php
class TodoList extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'todo_lists';

	/**
	 * Protected attributes
	 *
	 * @var string
	 */
	protected $fillable = ['name'];

	/**
	 * Associated Model TodoItem
	 *
	 * @var arr
	 */
	public function listItems()
	{
		return $this->hasMany('TodoItem');
	}

    public function scopeAuthorOnly($query)
    {
        return $query->where('user_id', '=', Auth::getUser()->id);
    }

	/**
	 * Associated Model User
	 *
	 * @var arr
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}

	/**
	 * Returns true if the todo list has completed items
	 *
	 * @var bool
	 */
	public function has_completed_items() 
	{
		if ($this->listItems()->completed()->count() > 0) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Returns true if todo list has any associated items
	 *
	 * @var bool
	 */
	public function has_any_items()
	{
		if ($this->total_item_count() > 0) {
			return true;
		} else {
			return false;
		}		
	}

	/**
	 * Returns the count of completed items for the todo list.
	 *
	 * @var int
	 */
	public function completed_item_count() 
	{
		return $this->listItems()->completed()->count();
	}

	/**
	 * Returns the count of total items for the todo list.
	 *
	 * @var int
	 */
	public function total_item_count() 
	{
		return $this->listItems()->count(); 
	}

	/**
	 * Returns a string of the current completed status
	 * of the todo list.
	 * 
	 * @var str
	 */
	public function get_list_status() 
	{
		$total = $this->total_item_count();		
		$completed = $this->completed_item_count();

		if ($this->has_completed_items()) 
		{
			if ($total === $completed) 
			{
				$str = "You have completed all the items in this list. Great job!";
			} 
			else 
			{
				$str = "You have completed $completed out of $total " . $this->plural_singular($total) . "." ;
			}
		} 

		elseif (!$this->has_completed_items() && $total > 0) 
		{
			$str = "You have $total " . $this->plural_singular($total) . " to complete.";
		} 

		else 
		{
			$str = "This list has no items. " . link_to_route('todos.items.create', 'Add Item', [$this->id]);
		}

		return $str;
	}

	/**
	 * Returns the percentage of completed items
	 * 
	 * @var int
	 */
	public function percent_completed()
	{
		$total = $this->total_item_count();		
		$completed = $this->completed_item_count();
		if ($total > 0 && $completed > 0) {
			return ($completed/$total) * 100;
		} else {
			return 0;
		}
	}

	/**
	 * Returns the plural or singular word 'item' depending
	 * on count of items.
	 *
	 * @var str
	 */
	public function plural_singular($count) 
	{
		if ($count === 1) {
			return "item";
		} else {
			return "items";
		}
	}	
	
}