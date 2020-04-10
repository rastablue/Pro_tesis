<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('placa')->unique();
            $table->string('modelo');
            $table->string('color')->nullable();
            $table->bigInteger('kilometraje')->unsigned()->nullable();
            $table->string('tipo_vehiculo')->nullable();
            $table->text('observacion')->nullable();
            $table->unsignedBigInteger('cliente_id')->index()->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('marca_id')->index()->nullable();
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
        Schema::dropIfExists('vehiculos');
    }
}
