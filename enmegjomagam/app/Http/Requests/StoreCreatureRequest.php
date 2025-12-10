<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCreatureRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:kategoriak,id',
        ];
    }

    /**
     * Prepare data for validation - map English field names to Hungarian database columns
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'nev' => $this->name,
            'leiras' => $this->description,
            'kategoria_id' => $this->category_id,
        ]);
    }
}
