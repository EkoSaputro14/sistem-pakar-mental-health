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
        Schema::table('diagnoses', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->change();
            $table->date('tanggal_lahir')->nullable()->after('user_id');
            $table->unsignedSmallInteger('semester')->nullable()->after('tanggal_lahir');
            $table->string('tahun_angkatan', 10)->nullable()->after('semester');
            $table->string('prodi')->nullable()->after('tahun_angkatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diagnoses', function (Blueprint $table) {
            $table->dropColumn(['tanggal_lahir', 'semester', 'tahun_angkatan', 'prodi']);
            $table->foreignId('user_id')->nullable(false)->change();
        });
    }
};
