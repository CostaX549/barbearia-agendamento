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
        Schema::create('cortes', function (Blueprint $table) {
            $table->id();
            $table->string("nome");
            $table->string("descricao");
            $table->float('preco');
            $table->unsignedBigInteger('barbeiro_id');
            $table->time("intervalo")->default('01:00:00');
            $table->foreign("barbeiro_id")->references('id')->on('barbeiros')->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cortes');
    }
};
