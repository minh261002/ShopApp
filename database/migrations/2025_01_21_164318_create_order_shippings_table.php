<?php

use App\Enums\Order\ShippingStatus;
use App\Enums\Shipping\ShippingMethod;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_shippings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->enum('shipping_method', ShippingMethod::getValues())->default(ShippingMethod::GHTK->value);
            $table->string('tracking_number')->nullable();
            $table->enum('shipping_status', ShippingStatus::getValues())->default(ShippingStatus::Pending->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_shippings');
    }
};