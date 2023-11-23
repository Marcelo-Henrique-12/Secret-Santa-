<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sorteios', function (Blueprint $table) {
            $table->string('ano_sorteio')->after('amigo_secreto_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sorteios', function (Blueprint $table) {
            $table->dropColumn('ano_sorteio');
        });
    }
};
