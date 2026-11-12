<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Nombre_Nota' => [
                'required',
                'string',
                'max:150'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'Nombre_Nota.required' =>
                'El nombre de la nota es obligatorio.',

            'Nombre_Nota.string' =>
                'El nombre de la nota debe ser un texto.',

            'Nombre_Nota.max' =>
                'El nombre de la nota no puede superar los 150 caracteres.'
        ];
    }
}
