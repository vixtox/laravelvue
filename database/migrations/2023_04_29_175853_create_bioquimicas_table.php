<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBioquimicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bioquimicas', function (Blueprint $table) {
            $table->id();
            $table->decimal('urea')->nullable();
            $table->decimal('creatinina')->nullable();
            $table->decimal('glucosa')->nullable();
            $table->decimal('proteinas')->nullable();
            $table->decimal('albumina')->nullable();
            $table->decimal('bilirrubina')->nullable();
            $table->decimal('gpt')->nullable();
            $table->decimal('fosforo')->nullable();
            $table->decimal('calcio')->nullable();
            $table->decimal('colesterol')->nullable();
            $table->decimal('trigliceridos')->nullable();
            $table->decimal('lipidos')->nullable();
            $table->decimal('cpk')->nullable();
            $table->decimal('amilasa')->nullable();
            $table->decimal('lipasa')->nullable();
            $table->decimal('sodio')->nullable();
            $table->decimal('potasio')->nullable();
            $table->decimal('cloro')->nullable();
            $table->decimal('t4')->nullable();
            $table->date('fecha');
            $table->string('animal');
            $table->timestamps();

            $table->unsignedBigInteger('mascotas_id');
            $table->foreign('mascotas_id')->references('id')->on('mascotas');

            $table->unsignedBigInteger('visita_id');
            $table->foreign('visita_id')->references('id')->on('visitas');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bioquimicas');
    }
}
