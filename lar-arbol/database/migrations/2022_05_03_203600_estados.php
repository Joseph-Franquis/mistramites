<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Estados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('estados', function(BluePrint $tabla) {
            $tabla->integerIncrements('id')->unsigned(false);
            $tabla->string('nombre');
            $tabla->text('descripcion');
            $tabla->date('created_at');
            $tabla->date('updated_at');
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
