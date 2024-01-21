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
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("barbeiro_id");
            $table->dateTime("start_date");
            $table->dateTime("end_date");
            $table->boolean('status')->default(0);
       
      
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");
            $table->foreign("barbeiro_id")->references('id')->on('barbeiros')->onDelete("cascade");
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendamentos');
    }
};
