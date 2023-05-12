<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRazasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('razas', function (Blueprint $table) {
            $table->id();
            $table->string('raza');
            $table->timestamps();
    
            $table->unsignedBigInteger('especie_id');
            $table->foreign('especie_id')->references('id')->on('especies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('razas');
    }
}