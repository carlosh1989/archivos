<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaDatosConcejal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('councilors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('avatar');
            $table->string('name');
            $table->string('cedula');
            $table->string('telefono');
            $table->string('comision');
            $table->text('direccion');
            $table->string('parroquia');
            $table->string('nacimiento');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE councilors ADD FULLTEXT(name, cedula, telefono, comision, direccion, parroquia, nacimiento)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('councilors');
    }
}
