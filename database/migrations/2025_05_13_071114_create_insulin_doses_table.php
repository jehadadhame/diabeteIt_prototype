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
        Schema::create('insulin_doses', function (Blueprint $table) {
            $table->id();
            $table->foreignId("patient_id")->references("id")->on("patients");
            $table->integer("dose_units");
            $table->enum("insulin_type", ["Basal", "Bolus"]);
            $table->timestamp("injected_at");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insulin_doses');
    }
};
