<?php

namespace Tests\Feature;

use App\Models\Symptom;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SymptomQuestionTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_symptom_with_question(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->post(route('admin.symptoms.store'), [
                'code' => 'A101',
                'name' => 'Internal symptom name',
                'question' => 'Apakah Anda merasa sulit menikmati aktivitas harian?',
                'base_cf' => 0.45,
                'is_active' => 1,
            ])
            ->assertRedirect(route('admin.symptoms.index'));

        $this->assertDatabaseHas('symptoms', [
            'code' => 'A101',
            'name' => 'Internal symptom name',
            'question' => 'Apakah Anda merasa sulit menikmati aktivitas harian?',
        ]);
    }

    public function test_admin_symptom_question_is_required(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->post(route('admin.symptoms.store'), [
                'code' => 'A102',
                'name' => 'Missing question symptom',
                'base_cf' => 0.45,
                'is_active' => 1,
            ])
            ->assertSessionHasErrors('question');
    }

    public function test_admin_can_update_symptom_question(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $symptom = Symptom::factory()->create([
            'code' => 'A103',
            'name' => 'Internal label',
            'question' => 'Pertanyaan lama?',
        ]);

        $this->actingAs($admin)
            ->put(route('admin.symptoms.update', $symptom), [
                'code' => 'A103',
                'name' => 'Internal label',
                'question' => 'Apakah Anda merasa energi menurun akhir-akhir ini?',
                'base_cf' => 0.55,
                'is_active' => 1,
            ])
            ->assertRedirect(route('admin.symptoms.index'));

        $this->assertDatabaseHas('symptoms', [
            'id' => $symptom->id,
            'question' => 'Apakah Anda merasa energi menurun akhir-akhir ini?',
        ]);
    }

    public function test_diagnosis_page_shows_question_not_internal_symptom_name(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        Symptom::factory()->create([
            'code' => 'A104',
            'name' => 'Internal-only symptom name',
            'question' => 'Apakah Anda sulit fokus saat mengerjakan tugas?',
            'is_active' => true,
        ]);

        $this->actingAs($user)
            ->get(route('user.diagnosis'))
            ->assertOk()
            ->assertSee('Apakah Anda sulit fokus saat mengerjakan tugas?')
            ->assertDontSee('Internal-only symptom name');
    }
}
