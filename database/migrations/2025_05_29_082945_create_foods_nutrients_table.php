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
        Schema::create('foods_nutrients', function (Blueprint $table) {
            $table->id();
            $table->foreignId("food_id")->references('id')->on('foods');
            $table->foreignId("nutrient_id")->references('id')->on('nutrients');
            $table->double("amount")->nullable(false);
            $table->double("min")->nullable(true);
            $table->double("max")->nullable(true);
            $table->double("median")->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods_nutrients');
    }
};
