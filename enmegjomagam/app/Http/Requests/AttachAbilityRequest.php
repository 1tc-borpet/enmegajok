<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttachAbilityRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ability_id' => 'required|exists:kepessegek,id',
        ];
    }

    /**
     * Prepare data for validation - map English field name to Hungarian database column
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'kepesseg_id' => $this->ability_id,
        ]);
    }
}
