<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTecnicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tecnicos', function (Blueprint $table) {
            $table->id('id_tecnico');
            $table->string('tipo_ced');
            $table->string('cedula')->unique();
            $table->string('nombre_tec');
            $table->string('apellido_tec');
            $table->string('direccion');
            $table->string('email')->unique();
            $table->string('telefono');
            $table->enum('status',['activo','inactivo'])->default('activo');
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
        Schema::dropIfExists('tecnicos');
    }
}
