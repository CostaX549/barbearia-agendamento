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
        Schema::create('user_corte', function (Blueprint $table) {
            $table->id();
   
            $table->unsignedBigInteger("corte_id");
            $table->unsignedBigInteger('barbearia_user_id'); // Recria a coluna barbearia_id
            $table->foreign('barbearia_user_id')->references('id')->on('barbearia_users')->onDelete('cascade');
            $table->foreign("corte_id")->references('id')->on('cortes')->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_corte');
    }
};
