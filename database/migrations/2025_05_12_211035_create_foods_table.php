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
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('calories', 5, 2);
            $table->decimal('carbs_grams', 5, 2);
            $table->decimal('fiber_grams', 5, 2);
            $table->decimal('protein_grams', 5, 2);
            $table->decimal('fat_grams', 5, 2);
            $table->decimal('net_carbs', 5, 2);
            $table->integer('glycemic_index');
            $table->decimal('glycemic_load', 5, 2);
            $table->enum('unit', ['ml', 'grams']); // for liquid ml, and for ;
            // category integer [ref: > food_categories.id]; 
            $table->string('image_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};
