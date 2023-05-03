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
            $table->id('id_empleado');
            $table->string('nombre_apellidos', 100);
            $table->string('documento_identidad', 20);
            $table->string('direccion', 100);
            $table->string('codigo_postal', 10);
            $table->string('municipio', 50);
            $table->string('provincia', 50);
            $table->string('telefono', 20);
            $table->string('email', 100);
            $table->date('fecha_contratacion');
            $table->decimal('salario', 10, 2);
            $table->string('cargo', 50);
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
        Schema::dropIfExists('empleados');
    }
}
