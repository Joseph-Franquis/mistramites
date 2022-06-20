<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Publicaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('publicaciones', function(BluePrint $tabla) {
            // $tabla->engine = 'InnoDB';
            $tabla->integerIncrements('id')->unsigned(false);
            $tabla->string('titulo');
            $tabla->text('contenido');
            $tabla->integer('usuario_id');
            $tabla->integer('estado_id');
            $tabla->timestamps();
            $tabla->foreign('usuario_id')
            ->references('id')->on('usuarios')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $tabla->foreign('estado_id')
            ->references('id')->on('estados')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
