<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_visita');
            $table->time('hora_visita')->nullable();
            $table->string('veterinario');
            $table->text('sintomas')->nullable();
            $table->text('diagnostico')->nullable();
            $table->text('tratamiento')->nullable();
            $table->decimal('coste', 10, 2)->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('mascotas_id');
            $table->foreign('mascotas_id')->references('id')->on('mascotas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitas');
    }
}
