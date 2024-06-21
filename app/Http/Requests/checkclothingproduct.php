<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class checkclothingproduct extends FormRequest
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
            'name' => 'required|min:2|max:20',
            'description' => 'required|min:5|max:100',
            'price' => 'required',
            'type' => 'required',
            'section_id' => 'required',
            'img' => 'required',
        ];
    }
}
