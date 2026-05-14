<?php

namespace Database\Seeders;

use App\Models\Depression;
use App\Models\Recommendation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecommendationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $data = [
                'D1' => [
                    ['title' => 'Strategi koping harian', 'content' => 'Coba atur rutinitas tidur, makan teratur, dan lakukan aktivitas fisik ringan 10–20 menit.'],
                    ['title' => 'Dukungan sosial', 'content' => 'Bicarakan perasaanmu kepada teman dekat/keluarga, dan pertimbangkan konseling kampus bila tersedia.'],
                ],
                'D2' => [
                    ['title' => 'Konsultasi profesional', 'content' => 'Disarankan berkonsultasi dengan psikolog/konselor untuk evaluasi dan rencana penanganan.'],
                    ['title' => 'Manajemen stres akademik', 'content' => 'Bagi tugas menjadi bagian kecil, gunakan to-do list, dan komunikasikan kesulitan ke dosen/PA.'],
                ],
                'D3' => [
                    ['title' => 'Segera cari bantuan', 'content' => 'Disarankan segera menghubungi psikolog/psikiater atau layanan kesehatan terdekat untuk penanganan intensif.'],
                    ['title' => 'Jaringan bantuan', 'content' => 'Minta bantuan orang terdekat untuk menemani. Jika merasa tidak aman, hubungi layanan darurat setempat.'],
                ],
            ];

            foreach ($data as $code => $items) {
                $depression = Depression::where('code', $code)->firstOrFail();

                foreach ($items as $item) {
                    Recommendation::updateOrCreate(
                        ['depression_id' => $depression->id, 'title' => $item['title']],
                        ['content' => $item['content'], 'is_active' => true]
                    );
                }
            }
        });
    }
}
