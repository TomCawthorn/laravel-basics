<?php

class TodoItemController extends \BaseController {


	public function __construct()
	{
		$this->beforeFilter('csrf', array('on' => ['post', 'put']));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($list_id)
	{
		$list = TodoList::findOrFail($list_id);
		return View::make('items.create')->withList($list);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($list_id)
	{

		$rules = ['content' => 'required|unique:todo_items,content,NULL,id,todo_list_id,' . $list_id ] ;
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			return Redirect::route('todos.items.create', [$list_id])->withErrors($validator)->withInput();
		}

		$content = Input::get('content');
		$item = new TodoItem(['content' => $content]);
		$list = TodoList::findOrFail($list_id);
		$item = $list->listItems()->save($item);

		return Redirect::route('todos.show', [$list_id])->withMessage('Item successfully added');
		
	}



	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($list_id, $item_id)
	{
		$item = TodoItem::findOrFail($item_id);
		$list = TodoList::findOrFail($list_id);
		return View::make('items.edit')->with('item', $item)->with('list', $list);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($list_id, $item_id)
	{

		$rules = ['content' => 'required|unique:todo_items,content,' . $item_id . ',id,todo_list_id,' . $list_id ] ;
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			return Redirect::route('todos.items.edit', [$list_id, $item_id])->withErrors($validator)->withInput();
		}

		$content = Input::get('content');
		$item = TodoItem::findOrFail($item_id);
		$item->content = $content;
		$item->update();
		return Redirect::route('todos.show', $list_id)->withMessage('List was updated');

	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($list_id, $item_id)
	{
		$todo_item = TodoItem::findOrFail($item_id)->delete();
		return Redirect::route('todos.show', $list_id)->withMessage('Item Deleted');
	}



	public function completed($list_id, $item_id) {
		$item = TodoItem::findOrFail($item_id);
		$item->toggle_completed() ;
		return Redirect::route('todos.show', $list_id)->withMessage('Item Updated');
	}


}
