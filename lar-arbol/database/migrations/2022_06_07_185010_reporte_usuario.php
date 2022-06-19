<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReporteUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('reportes_usuarios', function ($tabla) {
            $tabla->integerIncrements('id');
            $tabla->text('descripcion');
            $tabla->time('created_at')->index();
            $tabla->integer('usuario')->index();
            $tabla->foreign('usuario')
            ->references('id')->on('usuarios')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $tabla->integer('usuario_reportado')->index();
            $tabla->foreign('usuario_reportado')
            ->references('id')->on('usuarios')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $tabla->integer('reporte_tipo');
            $tabla->foreign('reporte_tipo')
            ->references('id')->on('reportes')
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
