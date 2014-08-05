<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToTodoLists extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('todo_lists', function($table) {
			$table->integer('user_id')->unsigned();
		});

		Schema::table('todo_lists', function($table) {
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
		Schema::table('todo_lists', function($table) {
			$table->dropColumn('user_id');
		});		
	}

}
