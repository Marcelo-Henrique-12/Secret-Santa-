<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sorteios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('participante_id');
            $table->unsignedBigInteger('amigo_secreto_id');
            $table->timestamps();

            $table->foreign('participante_id')->references('id')->on('participantes');
            $table->foreign('amigo_secreto_id')->references('id')->on('participantes');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sorteios');
    }

};
