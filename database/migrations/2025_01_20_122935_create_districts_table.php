<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type')->nullable();
            $table->string('slug')->nullable();
            $table->string('name_with_type')->nullable();
            $table->string('path')->nullable();
            $table->string('path_with_type')->nullable();
            $table->string('code')->unique();
            $table->string('parent_code')->nullable();
            $table->foreign('parent_code')->references('code')->on('provinces');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};