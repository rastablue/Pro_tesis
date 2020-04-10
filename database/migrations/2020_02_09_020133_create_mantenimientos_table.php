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
            $table->bigInteger('nro_ficha')->unique();
            $table->datetime('fecha_ingreso');
            $table->datetime('fecha_egreso')->nullable();
            $table->text('observacion')->nullable();
            $table->text('diagnostico')->nullable();
            $table->float('valor_total')->nullable();
            $table->enum('estado', ['Activo', 'Inactivo', 'En espera', 'Finalizado'])->nullable();
            $table->unsignedBigInteger('vehiculo_id')->index()->nullable();
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->string('path')->nullable();
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
