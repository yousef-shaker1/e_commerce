<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class check_register extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|min:5|max:30',
            'phone' => 'required|size:11',
            'birthdate' => 'required',
            'address' => 'required',
        ];
    }
}
