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
        Schema::create('promocaos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("barbearia_id");
            $table->string("name");
            $table->float("desconto");
            $table->dateTime("start_date");
            $table->dateTime("end_date");
            $table->longText("description")->nullable();
            $table->string("rule")->nullable();
          
            $table->foreign('barbearia_id')->references('id')->on('barbearias')->onDelete('cascade');
            $table->softDeletes();  
            $table->timestamps();
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promocaos');
    }
};
