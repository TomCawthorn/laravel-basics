<?php
class TodoItem extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'todo_items';


	protected $fillable = ['content', 'complete_on'];


	public function todoList()
	{
		return $this->belongsTo('TodoList');
	}


    public function scopeCompleted($query)
    {
        return $query->whereNotNull('completed_on');
    }


    public function scopeUncompleted($query)
    {
        return $query->where('completed_on', '=', NULL);
    }


	public function is_item_completed() 
	{
		if ($this->completed_on !== NULL) {
			return true;			
		} else {		
			return false;
		}
	}


	public function toggle_completed()
	{
		if (!$this->is_item_completed()) {
			$this->completed_on = date("Y-m-d H:i:s");
		} else {
			$this->completed_on = NULL;
		}
		$this->save();		
	}


}