<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccorciatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accorciatos', function (Blueprint $table) {
            $table->id();
            $table->string('url')->comment('URL');
            $table->string('cognaome')->comment('Cognaome dell\'abbreviato');
            $table->string('ip')->comment('Abbreviatore ip utente');
            $table->integer('visita')->default(0)->comment('Numero di visitatori');
            $table->integer('stato')->default(0)->comment('Stato di abbreviato');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accorciatos');
    }
}
