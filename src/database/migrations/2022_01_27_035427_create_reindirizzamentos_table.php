<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReindirizzamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reindirizzamentos', function (Blueprint $table) {
            $table->id();
            $table->string('accorciatos_id')->references('id')->on('accorciatos');
            $table->string('ip')->comment('Indirizzo IP');
            $table->string('ospite')->comment('Ospite/Host');
            $table->string('utente')->comment('Utente/UserAgent');
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
        Schema::dropIfExists('reindirizzamentos');
    }
}
