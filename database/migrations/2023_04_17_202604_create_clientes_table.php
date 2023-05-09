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
            $table->string('documento_identidad')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('domicilio')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->string('municipio')->nullable();
            $table->string('municipio_nombre')->nullable();
            $table->string('provincia')->nullable();
            $table->string('provincia_nombre')->nullable();
            $table->string('telefono');
            $table->string('email');
            $table->timestamp('deleted_at')->nullable();
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
