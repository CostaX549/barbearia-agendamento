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
            $table->unsignedBigInteger("owner_id");
            $table->unsignedBigInteger('barbearia_user_id'); 
            $table->foreign('barbearia_user_id')->references('id')->on('barbearia_users')->onDelete('cascade');
            $table->dateTime("start_date");
            $table->dateTime("end_date");
            $table->softDeletes();
     
            $table->boolean("read")->default(0);
            $table->timestamps();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete("cascade");
       
       
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
