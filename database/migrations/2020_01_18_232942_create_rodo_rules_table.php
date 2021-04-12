<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRodoRulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rodo_rules', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('title');
			$table->text('text', 65535);
			$table->integer('required')->default(1);
			$table->integer('time');
			$table->integer('status')->default(1);
			$table->timestamps();
			$table->integer('sort')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rodo_rules');
	}

}
