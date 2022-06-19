<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Comentarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('comentarios', function(BluePrint $tabla) {
            // $tabla->engine = 'InnoDB';
            $tabla->integerIncrements('id')->unsigned(false);
            $tabla->text('contenido');
            $tabla->integer('usuario_id');
            $tabla->integer('publicacion_id');
            $tabla->date('created_at');
            $tabla->date('updated_at');
            $tabla->foreign('usuario_id')
            ->references('id')->on('usuarios')
            ->onDelete('cascade');
            $tabla->foreign('publicacion_id')
            ->references('id')->on('publicaciones')
            ->onDelete('cascade');
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
