<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveUniqueKeyFromTodoListTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('todo_lists', function ($table)
		{
			$table->dropUnique('todo_lists_name_unique');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('todo_lists', function ($table)
		{
			$table->unique('name');
		});
	}

}
