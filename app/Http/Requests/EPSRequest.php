<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EPSRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Nombre_Eps' => 'required|string|max:150'
        ];
    }

    public function messages(): array
    {
        return [
            'Nombre_Eps.required' => 'El nombre de la EPS es obligatorio.',
            'Nombre_Eps.string' => 'El nombre de la EPS debe ser un texto.',
            'Nombre_Eps.max' => 'El nombre de la EPS no puede superar los 150 caracteres.'
        ];
    }
}
