<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordatoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recordatorios', function (Blueprint $table) {
            $table->id();
            $table->string('vacuna');
            $table->date('fecha');
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
        Schema::dropIfExists('recordatorios');
    }
}
