<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_apellidos', 100);
            $table->string('documento_identidad', 20)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('domicilio', 100)->nullable();
            $table->string('codigo_postal', 10)->nullable();
            $table->string('telefono', 20);
            $table->string('email', 100);
            $table->date('fecha_contratacion')->nullable();
            $table->decimal('salario', 10, 2)->nullable();
            $table->string('cargo', 50);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('provincia_id');
            $table->foreign('provincia_id')->references('id')->on('provincias');

            $table->unsignedBigInteger('municipio_id');
            $table->foreign('municipio_id')->references('id')->on('municipios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
