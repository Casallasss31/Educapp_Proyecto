<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BoletinRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $creacion = $this->isMethod('post');

        return [
            'Fecha_publicacion' => [
                $creacion ? 'required' : 'sometimes',
                'date_format:Y-m-d',
                'before_or_equal:today'
            ],

            'Periodo' => [
                $creacion ? 'required' : 'sometimes',
                Rule::in(['1', '2', '3'])
            ],

            'Observacion' => [
                'nullable',
                'string',
                'max:150'
            ],

            'Id_materia' => [
                $creacion ? 'required' : 'sometimes',
                'integer',
                'exists:materia,Id_Materia'
            ],

            'Id_estudiante' => [
                $creacion ? 'required' : 'sometimes',
                'integer',
                'exists:estudiante,Id_Estudiante'
            ],

            'Id_Boletin' => [
                'prohibited'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'Fecha_publicacion.required' =>
                'La fecha de publicación es obligatoria.',

            'Fecha_publicacion.date_format' =>
                'La fecha debe tener el formato AAAA-MM-DD.',

            'Fecha_publicacion.before_or_equal' =>
                'La fecha de publicación no puede ser futura.',

            'Periodo.required' =>
                'El periodo académico es obligatorio.',

            'Periodo.in' =>
                'El periodo debe ser 1, 2 o 3.',

            'Observacion.string' =>
                'La observación debe ser texto.',

            'Observacion.max' =>
                'La observación no puede superar los 150 caracteres.',

            'Id_materia.required' =>
                'La materia es obligatoria.',

            'Id_materia.integer' =>
                'El identificador de la materia debe ser un número entero.',

            'Id_materia.exists' =>
                'La materia seleccionada no existe.',

            'Id_estudiante.required' =>
                'El estudiante es obligatorio.',

            'Id_estudiante.integer' =>
                'El identificador del estudiante debe ser un número entero.',

            'Id_estudiante.exists' =>
                'El estudiante seleccionado no existe.',

            'Id_Boletin.prohibited' =>
                'No se permite enviar ni modificar el identificador del boletín.'
        ];
    }
}
