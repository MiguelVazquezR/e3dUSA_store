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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->string('brand');
            $table->string('model')->nullable();
            $table->json('colors')->nullable();
            $table->string('part_number');
            $table->string('material');
            $table->text('description');
            $table->text('features')->nullable();
            $table->unsignedFloat('price');
            $table->boolean('is_active')->default(true);
            $table->unsignedFloat('stock');
            $table->boolean('is_percentage')->nullable();
            $table->unsignedFloat('discount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
