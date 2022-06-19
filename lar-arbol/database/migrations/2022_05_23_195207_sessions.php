<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sessions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('sessions', function ($tabla) {
            $tabla->integerIncrements('id');
            $tabla->string('id_session')->nullable(false);
            $tabla->string('ip_address', 45)->nullable();
            $tabla->text('payload');
            $tabla->time('last_activity')->index();
            $tabla->integer('usuario_id')->nullable()->index();
            $tabla->foreign('usuario_id')
            ->references('id')->on('usuarios')
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
