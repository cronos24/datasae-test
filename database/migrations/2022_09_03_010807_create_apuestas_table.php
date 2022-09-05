<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApuestasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('apuestas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('ruleta_id')->index('fk_apuestas_ruleta1_idx');
			$table->decimal('valor', 12, 2);
			$table->integer('jugadores_id')->index('fk_apuestas_jugadores_idx');
			$table->integer('colores_id')->index('fk_apuestas_colores1_idx');
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
		Schema::drop('apuestas');
	}

}
