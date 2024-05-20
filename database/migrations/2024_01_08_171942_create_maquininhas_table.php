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
        Schema::create('maquininhas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("barbearia_user_id");
            $table->string("name");
            $table->float("taxa_debito")->nullable();
            $table->float("taxa_credito")->nullable();
            $table->foreign('barbearia_user_id')->references('id')->on('barbearia_users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maquininhas');
    }
};
