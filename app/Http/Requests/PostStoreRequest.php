<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'tytul' => 'required|min:3|max:200',
            'autor' => ['required', 'min:4', 'max:100'],
            'email' => ['required', 'email:rfc,dns'],
            'tresc' => ['required', 'min:5']
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'Pole jest wymagane',
            'min' => 'Pole wymagana minimum :min znaków',
            'max' => 'Pole wymaga maksimum :max znaków',
            'email' => 'Niepoprawny email'
        ];
    }
}
