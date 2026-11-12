<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatriculaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $creacion = $this->isMethod('post');

        return [
            'Fecha_Matricula' => [
                $creacion ? 'required' : 'sometimes',
                'date_format:Y-m-d',
                'before_or_equal:today'
            ],

            'Id_estudiante' => [
                $creacion ? 'required' : 'sometimes',
                'integer',
                'exists:estudiante,Id_Estudiante'
            ],

            'Id_Matricula' => [
                'prohibited'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'Fecha_Matricula.required' =>
                'La fecha de matrícula es obligatoria.',

            'Fecha_Matricula.date_format' =>
                'La fecha debe tener el formato AAAA-MM-DD.',

            'Fecha_Matricula.before_or_equal' =>
                'La fecha de matrícula no puede ser futura.',

            'Id_estudiante.required' =>
                'El estudiante es obligatorio.',

            'Id_estudiante.integer' =>
                'El identificador del estudiante debe ser un número entero.',

            'Id_estudiante.exists' =>
                'El estudiante seleccionado no existe.',

            'Id_Matricula.prohibited' =>
                'No se permite enviar ni modificar el identificador de la matrícula.'
        ];
    }
}
