<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'author' => 'nullable|string|max:150',
            'title' => 'required|string|max:100',
            'launchDate' => 'required|date',
            'price' => 'required|numeric|min:0',
            'enabled' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'O título é obrigatório.',
            'launchDate.required' => 'A data de lançamento é obrigatória.',
            'price.required' => 'O preço é obrigatório.',
            'price.min' => 'O preço deve ser maior ou igual a 0.',
        ];
    }
}