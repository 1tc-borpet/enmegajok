<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCreatureRequest extends FormRequest
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
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'sometimes|required|exists:kategoriak,id',
        ];
    }

    /**
     * Get validated data with Hungarian field names for database
     */
    public function validatedWithDbFields(): array
    {
        $validated = $this->validated();
        $data = [];
        
        if (isset($validated['name'])) {
            $data['nev'] = $validated['name'];
        }
        if (isset($validated['description'])) {
            $data['leiras'] = $validated['description'];
        }
        if (isset($validated['category_id'])) {
            $data['kategoria_id'] = $validated['category_id'];
        }
        
        return $data;
    }
}
