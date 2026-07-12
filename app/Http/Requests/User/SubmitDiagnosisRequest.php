<?php

namespace App\Http\Requests\User;

use App\Models\AnswerOption;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SubmitDiagnosisRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $validValues = AnswerOption::active()
            ->pluck('value')
            ->map(fn ($v) => (string) (float) $v)
            ->implode(',');

        return [
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'semester' => ['required', 'integer', 'min:1', 'max:14'],
            'tahun_angkatan' => ['required', 'string', 'max:10'],
            'prodi' => ['required', 'string', 'max:255'],
            'answers' => ['required', 'array', 'min:1'],
            'answers.*' => ['required', "in:{$validValues}"],
        ];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
            'semester.required' => 'Semester wajib diisi.',
            'semester.min' => 'Semester minimal 1.',
            'semester.max' => 'Semester maksimal 14.',
            'tahun_angkatan.required' => 'Tahun angkatan wajib diisi.',
            'prodi.required' => 'Program studi wajib diisi.',
            'answers.required' => 'Semua gejala wajib diisi.',
        ];
    }
}
