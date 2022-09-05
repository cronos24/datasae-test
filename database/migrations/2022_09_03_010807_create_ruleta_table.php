<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuletaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ruleta', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->dateTime('fecha');
			$table->decimal('valor_apostado', 12, 2)->nullable();
			$table->decimal('valor_pagado', 12, 2)->nullable();
			$table->char('estado', 1);
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
		Schema::drop('ruleta');
	}

}
