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
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable(false);
            $table->string('arabic_name')->nullable(false);
            $table->string("description")->nullable(false);
            $table->double("total_carbs")->nullable(false);
            $table->double("total_calories")->nullable(false);
            $table->enum("meal_type", ["breakfast", "lunch", "dinner", "snack"])->nullable(false);
            $table->boolean("is_custom")->nullable(false);
            $table->foreignId('patient_id')->nullable(true)->constrained('patients');
            $table->string("image_name");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meals');
    }
};
