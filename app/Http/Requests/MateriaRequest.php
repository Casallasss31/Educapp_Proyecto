<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MateriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $obligatorio = $this->isMethod('post')
            ? 'required'
            : 'sometimes';

        return [
            'Nombre_Materia' => [
                $obligatorio,
                'string',
                'max:150',
                'not_regex:/^\s*$/u'
            ],

            'Id_area' => [
                $obligatorio,
                'integer',
                'exists:area,Id_Area'
            ],

            'Id_nota' => [
                'nullable',
                'integer',
                'exists:nota,Id_Nota'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'Nombre_Materia.required' =>
                'El nombre de la materia es obligatorio.',

            'Nombre_Materia.string' =>
                'El nombre debe ser texto.',

            'Nombre_Materia.max' =>
                'El nombre no puede superar los 150 caracteres.',

            'Nombre_Materia.not_regex' =>
                'El nombre de la materia no puede contener solo espacios.',

            'Id_area.required' =>
                'El área académica es obligatoria.',

            'Id_area.integer' =>
                'El identificador del área debe ser un número entero.',

            'Id_area.exists' =>
                'El área seleccionada no existe.',

            'Id_nota.integer' =>
                'El identificador de la nota debe ser un número entero.',

            'Id_nota.exists' =>
                'La nota seleccionada no existe.'
        ];
    }
}
