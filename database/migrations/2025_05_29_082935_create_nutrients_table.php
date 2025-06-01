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
        Schema::create('nutrients', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('arabic_name')->nullable(false);
            $table->boolean('is_required')->default(0);
            $table->enum('unit_name', ['G', 'MG', 'UG', 'KCAL', 'IU', 'UMOL_TE', 'MCG_RE', 'PH', 'SP_GR', 'kJ', 'MG_ATE', 'MG_GAE']);
            $table->enum('type', ['macronutrient', 'other', 'mineral', 'vitamin']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nutrients');
    }
};
