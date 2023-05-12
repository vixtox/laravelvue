<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMascotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('chip')->nullable();
            $table->string('especie')->nullable();
            $table->string('raza')->nullable();
            $table->string('capa')->nullable();
            $table->string('caracter')->nullable();
            $table->string('sexo')->nullable();
            $table->string('estado')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->date('fecha_baja')->nullable();
            $table->string('causa_baja')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            
            $table->unsignedBigInteger('especie_id');
            $table->foreign('especie_id')->references('id')->on('especies');

            $table->unsignedBigInteger('razas_id');
            $table->foreign('razas_id')->references('id')->on('razas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mascotas');
    }
}
