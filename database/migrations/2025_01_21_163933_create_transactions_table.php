<?php

use App\Enums\Order\PaymentMethod;
use App\Enums\Order\PaymentStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->double('total_amount');
            $table->double('discount_amount')->default(0);
            $table->double('shipping_fee')->default(0);
            $table->double('grand_total');
            $table->enum('payment_method', PaymentMethod::getValues())->default(PaymentMethod::Cash->value);
            $table->enum('payment_status', PaymentStatus::getValues())->default(PaymentStatus::Pending->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};