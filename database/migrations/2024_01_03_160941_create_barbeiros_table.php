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
        Schema::create('barbeiros', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('avatar');
          
            $table->unsignedBigInteger("barbearia_id");
            $table->foreign('barbearia_id')->references('id')->on('barbearias')->onDelete("cascade");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barbeiros');
    }
};
