<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fake_id')->unique();
            $table->text('manobra')->nullable();
            $table->text('repuestos')->nullable();
            $table->float('costo_manobra')->unsigned()->nullable();
            $table->float('costo_repuestos')->unsigned()->nullable();
            $table->enum('estado', ['Activo', 'Inactivo', 'En espera', 'Finalizado'])->nullable();
            $table->enum('tipo', ['Preventivo', 'Correctivo'])->nullable();
            $table->unsignedBigInteger('mantenimiento_id')->index();
            $table->foreign('mantenimiento_id')->references('id')->on('mantenimientos')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('user_id')->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('trabajos');
    }
}
