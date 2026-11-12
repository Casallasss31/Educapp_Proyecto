<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfesionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Nombre_Profesion' => [
                'required',
                'string',
                'max:150'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'Nombre_Profesion.required' =>
                'El nombre de la profesión es obligatorio.',

            'Nombre_Profesion.string' =>
                'El nombre de la profesión debe ser un texto.',

            'Nombre_Profesion.max' =>
                'El nombre de la profesión no puede superar los 150 caracteres.'
        ];
    }
}
