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
        Schema::create('patients_edibles', function (Blueprint $table) {
            $table->id();
            $table->foreignId("patient_id")->references("id")->on("patients");
            $table->morphs('edibles');
            $table->integer('quantity');
            $table->timestamp("eating_time");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients_edibles');
    }
};
