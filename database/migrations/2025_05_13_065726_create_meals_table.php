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
            $table->string("name");
            $table->string("description");
            $table->double("carbs_grams");
            $table->double("protein_grams");
            $table->double("calories");
            $table->decimal('fat_grams', 5, 2);
            $table->decimal('fiber_grams', 5, 2);
            $table->decimal('glycemic_load', 5, 2);
            $table->decimal('net_carbs', 5, 2);
            $table->enum('meal_type', ['breakfast', 'lunch', 'dinner', 'snack']);
            $table->enum("unit", ['ml', 'grams']);
            $table->boolean('is_custom');
            $table->morphs('created_by');
            $table->string('image_url');
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
