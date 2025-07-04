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
        Schema::create('patient_meals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->references('id')->on("patients");
            $table->foreignId('meal_id')->references('id')->on("meals");
            $table->double('quantity');
            $table->timestamp('meal_time')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_meals');
    }
};
