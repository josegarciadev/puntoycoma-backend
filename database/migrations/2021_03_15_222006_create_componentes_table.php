<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('componentes', function (Blueprint $table) {
            $table->id('id_componente');
            $table->integer('id_orden')->unsigned();
            $table->string('tipo_comp');
            $table->string('modelo_comp');
            $table->string('serial_comp');
            $table->string('cap_comp');
            $table->foreign('id_orden')->references('id_orden')->on('ordenes');
            $table->date('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('componentes');
    }
}
