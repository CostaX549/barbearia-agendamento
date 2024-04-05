<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\DaysOfWeek;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_working_hours', function (Blueprint $table) {

            

            $table->id();
        
         
            $table->unsignedBigInteger('barbearia_user_id'); 
            $table->foreign('barbearia_user_id')->references('id')->on('barbearia_users')->onDelete('cascade');
     
  
       $table->unsignedBigInteger("day_of_week"); 
            $table->time('start_hour');
            $table->time('end_hour');
            $table->json('intervals')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_working_hours');
    }
};
