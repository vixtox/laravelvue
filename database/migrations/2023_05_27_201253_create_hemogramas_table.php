<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHemogramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hemogramas', function (Blueprint $table) {
            $table->id();
            $table->decimal('hematocrito')->nullable();
            $table->decimal('hemoglobina')->nullable();
            $table->decimal('g_rojo')->nullable();
            $table->decimal('vcm')->nullable();
            $table->decimal('hcm')->nullable();
            $table->decimal('chcm')->nullable();
            $table->decimal('reticulocitos')->nullable();
            $table->decimal('eosinofilos')->nullable();
            $table->decimal('linfocitos')->nullable();
            $table->decimal('monocitos')->nullable();
            $table->decimal('leucocitos')->nullable();
            $table->decimal('plaquetas')->nullable();
            $table->dateTime('fecha');
            $table->string('animal');
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
        Schema::dropIfExists('hemogramas');
    }
}
