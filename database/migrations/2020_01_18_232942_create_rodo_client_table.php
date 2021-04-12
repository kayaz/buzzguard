<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRodoClientTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rodo_client', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name');
			$table->string('mail');
			$table->timestamps();
			$table->string('ip', 20);
			$table->string('host');
			$table->string('browser');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rodo_client');
	}

}
