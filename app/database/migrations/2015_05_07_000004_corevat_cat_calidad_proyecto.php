<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatCatCalidadProyecto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('corevat')->create('cat_calidad_proyecto', function(Blueprint $table) {
			$table->increments('idcalidadproyecto');
			$table->string('calidad_proyecto', 50);
			$table->integer('status_calidad_proy')->default(1);
			$table->integer('idemp')->default(1);
			$table->string('ip', 50)->default('');
			$table->string('host', 100)->default('');
			$table->integer('creado_por')->default(0);
			$table->timestamp('creado_el')->default('1970-01-01 00:00:00');
			$table->integer('modi_por')->default(0);
			$table->timestamp('modi_el')->default('1970-01-01 00:00:00');
			$table->foreign('idemp')->references('idemp')->on('empresas')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::connection('corevat')->getPdo()->exec("DROP TABLE IF EXISTS cat_calidad_proyecto CASCADE;");
	}

}