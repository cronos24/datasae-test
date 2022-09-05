<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToApuestasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('apuestas', function(Blueprint $table)
		{
			$table->foreign('colores_id', 'fk_apuestas_colores1')->references('id')->on('colores')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('jugadores_id', 'fk_apuestas_jugadores')->references('id')->on('jugadores')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('ruleta_id', 'fk_apuestas_ruleta1')->references('id')->on('ruleta')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('apuestas', function(Blueprint $table)
		{
			$table->dropForeign('fk_apuestas_colores1');
			$table->dropForeign('fk_apuestas_jugadores');
			$table->dropForeign('fk_apuestas_ruleta1');
		});
	}

}
