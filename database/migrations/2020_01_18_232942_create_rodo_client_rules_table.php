<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRodoClientRulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rodo_client_rules', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_rule');
			$table->integer('id_client');
			$table->dateTime('created_at')->nullable();
			$table->integer('duration');
			$table->integer('months');
			$table->string('ip', 15);
			$table->integer('status');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rodo_client_rules');
	}

}
