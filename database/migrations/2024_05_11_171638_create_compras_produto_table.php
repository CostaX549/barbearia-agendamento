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
        Schema::create('compras_produto', function (Blueprint $table) {
            $table->id();
              $table->unsignedBigInteger("produto_id");
               $table->unsignedBigInteger("compra_id");
               $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
               $table->foreign('compra_id')->references('id')->on('compras')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras_produto');
    }
};
