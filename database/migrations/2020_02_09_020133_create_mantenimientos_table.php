<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMantenimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('nro_ficha');
            $table->datetime('fecha_ingreso');
            $table->datetime('fecha_egreso');
            $table->text('observacion');
            $table->enum('estado', ['Activo', 'Inactivo', 'En espera', 'Finalizado'])->nullable();
            $table->enum('tipo', ['Preventivo', 'Correctivo'])->nullable();
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
        Schema::dropIfExists('mantenimientos');
    }
}
