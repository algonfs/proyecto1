<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViajesTable extends Migration
{
    public function up()
    {
        Schema::create('viajes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idconductor')->unsigned();
            $table->foreign('idconductor')->references('id')->on('conductores');
            $table->integer('idbus')->unsigned();
            $table->foreign('idbus')->references('id')->on('buses');
            $table->integer('idruta')->unsigned();
            $table->foreign('idruta')->references('id')->on('rutas');
            $table->string('descripcion');
            $table->boolean('condicion')->default(1);
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
        Schema::dropIfExists('viajes');
    }
}
