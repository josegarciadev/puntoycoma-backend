<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('codigo_producto')->unique();
            $table->string('nombre_prod');
            $table->string('descripcion_prod');
            $table->integer('id_categoria')->unsigned();
            $table->integer('id_fabricante')->unsigned();
            $table->float('stock');
            $table->float('precio');
            $table->string('foto');
            $table->enum('status',['activo','inactivo'])->default('activo');
            $table->foreign('id_categoria')->references('id_categoria')->on('categoria');
            $table->foreign('id_fabricante')->references('id_fabricante')->on('fabricante');
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
        Schema::dropIfExists('producto');
    }
}
