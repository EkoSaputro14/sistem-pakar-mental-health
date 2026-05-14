<?php

namespace Database\Seeders;

use App\Models\Symptom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $symptoms = [
                ['code' => 'A001', 'name' => 'Sudden sadness', 'question' => 'Apakah Anda sering merasa sedih secara tiba-tiba?', 'base_cf' => 0.30],
                ['code' => 'A002', 'name' => 'Fatigue without exertion', 'question' => 'Apakah Anda sering merasa lelah meskipun tidak melakukan aktivitas berat?', 'base_cf' => 0.30],
                ['code' => 'A003', 'name' => 'Feelings of worthlessness', 'question' => 'Apakah Anda merasa diri Anda tidak berharga?', 'base_cf' => 0.20],
                ['code' => 'A004', 'name' => 'Lack of motivation', 'question' => 'Apakah Anda kehilangan motivasi untuk menjalani aktivitas sehari-hari?', 'base_cf' => 0.40],
                ['code' => 'A005', 'name' => 'Shortness of breath', 'question' => 'Apakah Anda mengalami sesak napas saat merasa tertekan atau cemas?', 'base_cf' => 0.50],
                ['code' => 'A006', 'name' => 'Trouble sleeping', 'question' => 'Apakah Anda mengalami kesulitan tidur atau tidur tidak nyenyak?', 'base_cf' => 0.50],
                ['code' => 'A007', 'name' => 'Loss of appetite', 'question' => 'Apakah nafsu makan Anda menurun dalam beberapa waktu terakhir?', 'base_cf' => 0.60],
                ['code' => 'A008', 'name' => 'Slowed reflexes', 'question' => 'Apakah Anda merasa gerakan atau respons tubuh menjadi lebih lambat?', 'base_cf' => 0.40],
                ['code' => 'A009', 'name' => 'Inability to care for self', 'question' => 'Apakah Anda kesulitan merawat diri sendiri seperti mandi, makan, atau menjaga kebersihan?', 'base_cf' => 0.70],
                ['code' => 'A010', 'name' => 'Difficulty concentrating', 'question' => 'Apakah Anda sulit berkonsentrasi saat belajar atau mengerjakan tugas?', 'base_cf' => 0.80],
                ['code' => 'A011', 'name' => 'Difficulty managing time', 'question' => 'Apakah Anda kesulitan mengatur waktu untuk aktivitas harian atau akademik?', 'base_cf' => 0.80],
                ['code' => 'A012', 'name' => 'Hallucinations', 'question' => 'Apakah Anda pernah melihat atau mendengar sesuatu yang tidak dirasakan orang lain?', 'base_cf' => 0.60],
            ];

            foreach ($symptoms as $symptom) {
                Symptom::updateOrCreate(
                    ['code' => $symptom['code']],
                    [...$symptom, 'is_active' => true]
                );
            }
        });
    }
}
