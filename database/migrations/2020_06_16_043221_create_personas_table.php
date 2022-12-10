<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('cedula')->unique();
            $table->string('direccion');
            $table->integer('telefono');
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
