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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('patern_last_name');
            $table->string('mother_last_name');
            $table->string('rfc');
            $table->string('tax_regime');
            $table->string('cfdi_use');
            $table->string('postal_code');
            $table->string('street');
            $table->string('outdoor_number')->nullable();
            $table->string('interior_number');
            $table->string('colony');
            $table->string('city_halll'); //municipio o delegacion
            $table->string('city');
            $table->string('state');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
