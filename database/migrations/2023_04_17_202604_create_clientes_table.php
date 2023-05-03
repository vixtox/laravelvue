<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_apellidos');
            $table->string('documento_identidad');
            $table->date('fecha_nacimiento');
            $table->string('domicilio');
            $table->string('codigo_postal');
            $table->string('municipio');
            $table->string('provincia');
            $table->string('provincia_nombre');
            $table->string('telefono');
            $table->string('email');
            $table->string('estado');
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
        Schema::dropIfExists('clientes');
    }
}
