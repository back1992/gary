<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavmenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('navmenus', function(Blueprint $table)
		{
			// $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			$table->integer('parent_id')->unsigned();
			$table->string('title');
			$table->string('label');
			$table->text('url');
			$table->string('roles');
			$table->integer('order')->unsigned();
			$table->boolean('is_seperator')->default(false);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `Posts` table
		Schema::drop('navmenus');
	}

}
