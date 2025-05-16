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
        Schema::create('patients_exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignId("patient_id")->references("id")->on("patients");
            $table->foreignId("exercise_id")->references("id")->on("exercises");
            $table->integer("duration_min");
            $table->timestamp("performed_at");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients_exercises');
    }
};
