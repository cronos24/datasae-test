<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJugadoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jugadores', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('n_documento');
			$table->string('nombres', 60);
			$table->string('apellidos', 60);
			$table->decimal('telefono', 16, 2);			
			$table->decimal('dinero', 12, 2)->default(10000.00);
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
		Schema::drop('jugadores');
	}

}
