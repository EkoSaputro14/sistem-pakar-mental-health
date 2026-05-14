<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRuleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() === true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'depression_id' => ['required', 'integer', 'exists:depressions,id'],
            'symptom_id' => ['required', 'integer', 'exists:symptoms,id'],
            'expert_cf' => ['required', 'numeric', 'min:0', 'max:1'],
        ];
    }
}
