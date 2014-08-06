<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsersIdToTodoLists extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasColumn('todo_lists', 'user_id')) {
			Schema::table('todo_lists', function($table)
			{
				$table->integer('user_id')->unsigned();
			});
		}

		Schema::table('todo_lists', function ($table) {
			$table->foreign('user_id')
      			->references('id')->on('users')
      			->onDelete('cascade')
      			->onUpdate('cascade');
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
			$table->dropColumn('user_id');	
		});
		
	}

}
