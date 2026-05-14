<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('symptoms', function (Blueprint $table) {
            $table->text('question')->nullable()->after('name');
        });

        DB::table('symptoms')
            ->orderBy('id')
            ->select(['id', 'name'])
            ->chunkById(100, function ($symptoms): void {
                foreach ($symptoms as $symptom) {
                    DB::table('symptoms')
                        ->where('id', $symptom->id)
                        ->update(['question' => $symptom->name]);
                }
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('symptoms', function (Blueprint $table) {
            $table->dropColumn('question');
        });
    }
};
