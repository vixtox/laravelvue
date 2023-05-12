<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePruebasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pruebas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('tipo', 100);
            $table->string('archivo', 255);
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
        Schema::dropIfExists('pruebas');
    }
}
