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
        Schema::create('avaliacaos', function (Blueprint $table) {
            $table->id();
            $table->integer("qtd");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("barbearia_id");
            $table->string("comment")->nullable();
            $table->timestamps();
            $table->foreign("barbearia_id")->references('id')->on('barbearias')->onDelete("cascade");
            $table->foreign("user_id")->references('id')->on('users')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaliacaos');
    }
};
