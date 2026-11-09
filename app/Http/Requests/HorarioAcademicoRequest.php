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
        return [
            'Dias_semana' => 'required|string|max:100',
            'Hora_inicio' => 'required|date_format:H:i:s',
            'Horario_final' => 'required|date_format:H:i:s|after:Hora_inicio',
            'Id_curso' => 'required|integer|exists:curso,Id_Curso',
            'Id_materia' => 'required|integer|exists:materia,Id_Materia',
        ];
    }
}