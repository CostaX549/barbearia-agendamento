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
        Schema::create('agendamentos_cortes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("agendamento_id");
            $table->unsignedBigInteger("user_corte_id");
            $table->timestamps();
            $table->foreign("agendamento_id")->references('id')->on('agendamentos')->onDelete("cascade");
            $table->foreign("user_corte_id")->references('id')->on('user_corte')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendamentos_cortes');
    }
};
