<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Etiquetas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('etiquetas', function(BluePrint $tabla) {
            // $tabla->engine = 'InnoDB';
            $tabla->integerIncrements('id')->unsigned(false);
            $tabla->string('nombre');
            $tabla->text('descripcion');
            $tabla->timestamps();
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
