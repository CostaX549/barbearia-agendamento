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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->decimal('preco', 10, 2)->nullable();
           $table->string('nome');
           $table->integer('quantidade')->default(0);
            $table->string('imagem')->nullable();
           $table->string('dimensao')->nullable();
           $table->string('codigo')->unique();
           $table->text('descricao')->nullable();
            $table->date('validade')->nullable();
           $table->string('categoria')->nullable();
            $table->unsignedBigInteger('estoque_id');
             $table->foreign('estoque_id')->references('id')->on('estoques')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
