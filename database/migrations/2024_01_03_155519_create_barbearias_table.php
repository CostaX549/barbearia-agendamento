<?php

use App\Enums\PaymentMethods;
use App\Enums\PlanTypes;
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

      

        Schema::create('barbearias', function (Blueprint $table) {

            $paymentMethodValues = [];

            foreach (PaymentMethods::cases() as $case) {
                $paymentMethodValues[] = $case->value;
            }

            $planTypeValues = [];

            foreach (PlanTypes::cases() as $plan) {
                $planTypeValues[] = $plan->value;
            }

            $table->id();
            $table->string("nome");
            $table->string("imagem");
            $table->string("cep");
            $table->string("rua");
            $table->string("estado");
            $table->string("cidade");
            $table->string("complemento");
         
            $table->enum('payment_method', $paymentMethodValues)->nullable();
            $table->string("card_id")->nullable();
            $table->enum('price', $planTypeValues)->nullable(); // Usando array_values()
            $table->timestamp('plan_ends_at')->nullable();

            $table->softDeletes();
            $table->unsignedBigInteger("owner_id");
            $table->timestamps();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barberias');
    }
};
