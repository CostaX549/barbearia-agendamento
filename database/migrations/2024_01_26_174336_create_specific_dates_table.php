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
        Schema::create('specific_dates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("barbeiro_id");  
            $table->dateTime("start_date");
            $table->dateTime("end_date");
            $table->string("status");
            $table->foreign('barbeiro_id')->references('id')->on('barbeiros')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specific_dates');
    }
};
