<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('colores', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('color', 45)->unique('color_UNIQUE');
			$table->decimal('probabilidad', 5, 2);
			$table->decimal('recompensa', 5, 2);
			$table->char('estado', 1)->default('A');
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
		Schema::drop('colores');
	}

}
