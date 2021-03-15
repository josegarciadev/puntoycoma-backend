<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id('id_orden');
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_tecnico');
            $table->unsignedBigInteger('id_categoria');
            $table->string('marca');
            $table->string('modelo');
            $table->string('observacion');
            $table->string('status');
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes');
            $table->foreign('id_tecnico')->references('id_tecnico')->on('tecnicos');
            $table->foreign('id_categoria')->references('id_categoria')->on('categoria');
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
        Schema::dropIfExists('ordenes');
    }
}
