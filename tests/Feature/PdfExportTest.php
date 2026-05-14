<?php

namespace Tests\Feature;

use App\Models\Diagnosis;
use App\Models\DiagnosisDetail;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class PdfExportTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_user_can_download_their_diagnosis_pdf(): void
    {
        $user = User::factory()->create();

        $diagnosis = Diagnosis::factory()
            ->for($user)
            ->create([
                'cf_value' => 0.75,
                'cf_breakdown' => ['D1' => 0.55, 'D2' => 0.2],
            ]);

        DiagnosisDetail::factory()->for($diagnosis)->count(2)->create();

        $response = $this->actingAs($user)->get(route('user.result.pdf', $diagnosis));

        $response->assertOk();
        $this->assertStringContainsString('application/pdf', (string) $response->headers->get('content-type'));
    }

    public function test_user_cannot_download_someone_elses_diagnosis_pdf(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();

        $diagnosis = Diagnosis::factory()->for($owner)->create();

        $this->actingAs($other)
            ->get(route('user.result.pdf', $diagnosis))
            ->assertNotFound();
    }

    public function test_admin_can_download_any_diagnosis_pdf(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $diagnosis = Diagnosis::factory()->create([
            'cf_breakdown' => ['D1' => 0.1, 'D2' => 0.4, 'D3' => 0.7],
        ]);

        DiagnosisDetail::factory()->for($diagnosis)->count(1)->create();

        $response = $this->actingAs($admin)->get(route('admin.diagnoses.pdf', $diagnosis));

        $response->assertOk();
        $this->assertStringContainsString('application/pdf', (string) $response->headers->get('content-type'));
    }
}
