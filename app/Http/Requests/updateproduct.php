<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateproduct extends FormRequest
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
            'name' => 'nullable|min:2|max:30',
            'description' => 'nullable|min:5|max:50',
            'price' => 'nullable',
            'amount' => 'nullable',
            'img' => 'sometimes|nullable|file|image',
            'section_id' => 'nullable',
        ];
    }
}
