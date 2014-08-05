<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodoItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('todo_items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('todo_list_id');
			$table->string('content');
			$table->dateTime('completed_on')->nullable();
			$table->timestamps();
		});


		Schema::table('todo_items', function ($table) {
			$table->foreign('todo_list_id')
      			->references('id')->on('todo_lists')
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
		Schema::drop('todo_items');
	}

}
