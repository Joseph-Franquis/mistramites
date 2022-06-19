<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Usuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('usuarios', function (Blueprint $tabla) {
            // $tabla->engine = 'InnoDB';
            $tabla->integerIncrements('id')->unsigned(false);
            $tabla->string('usuario');
            $tabla->string('nombre');
            $tabla->string('correo');
            $tabla->string('password');
            $tabla->integer('usuario_rol');
            $tabla->rememberToken();
            $tabla->date('created_at');
            $tabla->date('updated_at');
            $tabla->foreign('usuario_rol')
            ->references('id')->on('roles')
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
