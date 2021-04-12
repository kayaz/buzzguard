<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInlinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inlines', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_place');
			$table->string('modaltytul')->nullable();
			$table->text('modaleditor', 65535)->nullable();
			$table->text('modaleditortext', 65535)->nullable();
			$table->string('modallink')->nullable();
			$table->string('modallinkbutton')->nullable();
			$table->string('obrazek')->nullable();
			$table->string('obrazek_alt')->nullable();
			$table->integer('obrazek_width')->nullable();
			$table->integer('obrazek_height')->nullable();
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
		Schema::drop('inlines');
	}

}
