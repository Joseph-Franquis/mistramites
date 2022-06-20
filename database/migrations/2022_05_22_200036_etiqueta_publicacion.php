<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EtiquetaPublicacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('etiqueta_publicacion', function(BluePrint $tabla) {
            // $tabla->engine = 'InnoDB';
            $tabla->integerIncrements('id')->unsigned(false);
            $tabla->integer('etiqueta_id');
            $tabla->integer('publicacion_id');
            $tabla->date('created_at');
            $tabla->foreign('etiqueta_id')
            ->references('id')->on('etiquetas')
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
