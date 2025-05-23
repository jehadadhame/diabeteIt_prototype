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
        Schema::create('food_in_meal', function (Blueprint $table) {
            $table->id();
            $table->foreignId("food_id")->references("id")->on("foods");
            $table->foreignId("meal_id")->references("id")->on("meals");
            $table->integer('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_in_meal');
    }
};
