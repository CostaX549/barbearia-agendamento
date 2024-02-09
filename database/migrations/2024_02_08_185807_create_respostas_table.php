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
        Schema::create('respostas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("avaliacao_id");
            $table->string("text");
            $table->timestamps();
            $table->foreign("user_id")->references('owner_id')->on('barbearias')->onDelete("cascade");
            $table->foreign("avaliacao_id")->references('id')->on('avaliacaos')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respostas');
    }
};
