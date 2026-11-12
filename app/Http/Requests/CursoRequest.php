<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CursoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $creacion = $this->isMethod('post');

        return [
            'Id_Curso' => $creacion
                ? [
                    'required',
                    'integer',
                    'min:1',
                    'max:2147483647',
                    'unique:curso,Id_Curso'
                ]
                : ['prohibited'],

            'Año' => [
                $creacion ? 'required' : 'sometimes',
                'integer',
                'between:2000,2100'
            ],

            'Id_grado' => [
                $creacion ? 'required' : 'sometimes',
                'integer',
                'exists:grado,Id_Grado'
            ],

            'Id_docente' => [
                'nullable',
                'integer',
                'exists:docente,Id_Docente'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'Id_Curso.required' =>
                'El identificador del curso es obligatorio.',

            'Id_Curso.integer' =>
                'El identificador debe ser un número entero.',

            'Id_Curso.min' =>
                'El identificador debe ser mayor que cero.',

            'Id_Curso.max' =>
                'El identificador supera el límite permitido.',

            'Id_Curso.unique' =>
                'Este identificador ya está registrado.',

            'Id_Curso.prohibited' =>
                'No se permite modificar el identificador del curso.',

            'Año.required' =>
                'El año académico es obligatorio.',

            'Año.integer' =>
                'El año académico debe ser un número entero.',

            'Año.between' =>
                'El año académico debe estar entre 2000 y 2100.',

            'Id_grado.required' =>
                'El grado es obligatorio.',

            'Id_grado.integer' =>
                'El identificador del grado debe ser un número entero.',

            'Id_grado.exists' =>
                'El grado seleccionado no existe.',

            'Id_docente.integer' =>
                'El identificador del docente debe ser un número entero.',

            'Id_docente.exists' =>
                'El docente seleccionado no existe.'
        ];
    }
}
