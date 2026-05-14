<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSymptomRequest extends FormRequest
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
            'code' => ['required', 'string', 'max:10', 'unique:symptoms,code'],
            'name' => ['required', 'string', 'max:255'],
            'question' => ['required', 'string', 'max:1000'],
            'base_cf' => ['required', 'numeric', 'min:0', 'max:1'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
