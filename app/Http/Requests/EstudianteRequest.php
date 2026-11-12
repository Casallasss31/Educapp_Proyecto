<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstudianteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $creacion = $this->isMethod('post');

        return [
            'Id_Estudiante' => $creacion
                ? [
                    'required',
                    'integer',
                    'min:1',
                    'max:2147483647',
                    'unique:estudiante,Id_Estudiante'
                ]
                : ['prohibited'],

            'Id_usuario' => [
                $creacion ? 'required' : 'sometimes',
                'integer',
                'exists:usuarios,Id_usuario'
            ],

            'Id_acudiente' => [
                $creacion ? 'required' : 'sometimes',
                'integer',
                'exists:acudiente,Id_Acudiente'
            ],

            'Id_Curso' => [
                $creacion ? 'required' : 'sometimes',
                'integer',
                'exists:curso,Id_Curso'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'Id_Estudiante.required' =>
                'El identificador del estudiante es obligatorio.',

            'Id_Estudiante.integer' =>
                'El identificador debe ser un número entero.',

            'Id_Estudiante.min' =>
                'El identificador debe ser mayor que cero.',

            'Id_Estudiante.max' =>
                'El identificador supera el límite permitido.',

            'Id_Estudiante.unique' =>
                'Este identificador ya está registrado.',

            'Id_Estudiante.prohibited' =>
                'No se permite modificar el identificador del estudiante.',

            'Id_usuario.required' =>
                'El usuario es obligatorio.',

            'Id_usuario.integer' =>
                'El identificador del usuario debe ser un número entero.',

            'Id_usuario.exists' =>
                'El usuario seleccionado no existe.',

            'Id_acudiente.required' =>
                'El acudiente es obligatorio.',

            'Id_acudiente.integer' =>
                'El identificador del acudiente debe ser un número entero.',

            'Id_acudiente.exists' =>
                'El acudiente seleccionado no existe.',

            'Id_Curso.required' =>
                'El curso es obligatorio.',

            'Id_Curso.integer' =>
                'El identificador del curso debe ser un número entero.',

            'Id_Curso.exists' =>
                'El curso seleccionado no existe.'
        ];
    }
}
