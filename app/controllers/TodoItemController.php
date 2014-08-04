<?php

class TodoItemController extends \BaseController {


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
		$list_id = $list_id;
		$item = new TodoItem();
		$item->content = $content;
		$item->todo_list_id = $list_id;
		$item->save();
		return Redirect::route('todos.show', [$list_id])->withMessage('Item successfully added');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function show($list_id, $item_id)
	{
		$item = TodoItem::findOrFail($item_id);
		return View::make('items.show')
			->with('item', $item);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
