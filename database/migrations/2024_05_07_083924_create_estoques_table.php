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
        Schema::create('estoques', function (Blueprint $table) {
            $table->id();
            $table->integer('capacidade')->nullable();
            $table->integer('quantidade_minima')->default(0);
            $table->integer('quantidade_maxima')->nullable();
            $table->unsignedBigInteger('barbearia_id');
            $table->foreign('barbearia_id')->references('id')->on('barbearias')->onDelete('cascade');
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estoques');
    }
};
