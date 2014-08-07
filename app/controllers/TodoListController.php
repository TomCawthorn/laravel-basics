<?php

class TodoListController extends \BaseController {


	public function __construct()
	{
		$this->beforeFilter('csrf', array('on' => ['post', 'put']));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$todo_lists = Sentry::getUser()->todoLists()->get();
		return View::make('todos.index')->with('todo_lists', $todo_lists);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('todos.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = Sentry::getUser();
		$rules = 
		[	
			'name' => 'required|unique:todo_lists,name,NULL,id,user_id,' . $user->id
		];
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			return Redirect::route('todos.create')->withErrors($validator)->withInput();
		}

		$name = Input::get('name');
		$list = new TodoList(['name' => $name]);
		$list = $user->todoLists()->save($list);

		if ($list !== false) {
			return Redirect::route('todos.show', $list->id)->withMessage('List was created');
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//$list = TodoList::findOrFail($id);
		$list = TodoList::findOrFail($id);
		$items = $list->listItems()->get();
		return View::make('todos.show')
			->withList($list)
			->withItems($items);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$list = TodoList::findOrFail($id);
		return View::make('todos.edit')->withList($list);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		$rules = ['name' => 'required|unique:todo_lists,name,' . $id ] ;
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			return Redirect::route('todos.edit', $id)->withErrors($validator)->withInput();
		}

		$name = Input::get('name');
		$list = TodoList::findOrFail($id);
		$list->name = $name;
		$list->update();
		return Redirect::route('todos.index')->withMessage('List was updated');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$todo_list = TodoList::findOrFail($id)->delete();
		return Redirect::route('todos.index')->withMessage('Item Deleted');
	}


}
