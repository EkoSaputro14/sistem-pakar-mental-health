<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diagnosis_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diagnosis_id')->constrained('diagnoses')->cascadeOnDelete();
            $table->foreignId('symptom_id')->constrained('symptoms')->cascadeOnDelete();
            $table->string('user_answer', 50);
            $table->decimal('user_cf', 4, 2)->default(0);
            $table->decimal('expert_cf', 4, 2)->default(0);
            $table->decimal('cf_he', 6, 4)->default(0);
            $table->timestamps();

            $table->unique(['diagnosis_id', 'symptom_id']);
            $table->index(['diagnosis_id']);
            $table->index(['symptom_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnosis_details');
    }
};
