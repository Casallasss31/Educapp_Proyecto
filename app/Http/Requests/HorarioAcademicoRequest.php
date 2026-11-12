<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HorarioAcademicoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $creacion = $this->isMethod('post');

        return [
            'Dias_semana' => [
                $creacion ? 'required' : 'sometimes',
                'string',
                'max:100',
                'not_regex:/^\s*$/u'
            ],

            'Hora_inicio' => [
                $creacion ? 'required' : 'sometimes',
                'date_format:H:i:s'
            ],

            'Horario_final' => [
                $creacion ? 'required' : 'sometimes',
                'date_format:H:i:s'
            ],

            'Id_curso' => [
                $creacion ? 'required' : 'sometimes',
                'integer',
                'exists:curso,Id_Curso'
            ],

            'Id_materia' => [
                $creacion ? 'required' : 'sometimes',
                'integer',
                'exists:materia,Id_Materia'
            ],

            'Id_Horario_Academico' => [
                'prohibited'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'Dias_semana.required' =>
                'El día de la semana es obligatorio.',

            'Dias_semana.string' =>
                'El día debe ser texto.',

            'Dias_semana.max' =>
                'El día no puede superar los 100 caracteres.',

            'Dias_semana.not_regex' =>
                'El día no puede contener solo espacios.',

            'Hora_inicio.required' =>
                'La hora de inicio es obligatoria.',

            'Hora_inicio.date_format' =>
                'La hora de inicio debe tener formato HH:MM:SS.',

            'Horario_final.required' =>
                'La hora de finalización es obligatoria.',

            'Horario_final.date_format' =>
                'La hora final debe tener formato HH:MM:SS.',

            'Id_curso.required' =>
                'El curso es obligatorio.',

            'Id_curso.integer' =>
                'El identificador del curso debe ser entero.',

            'Id_curso.exists' =>
                'El curso seleccionado no existe.',

            'Id_materia.required' =>
                'La materia es obligatoria.',

            'Id_materia.integer' =>
                'El identificador de la materia debe ser entero.',

            'Id_materia.exists' =>
                'La materia seleccionada no existe.',

            'Id_Horario_Academico.prohibited' =>
                'No se permite enviar ni modificar el identificador del horario.'
        ];
    }
}
