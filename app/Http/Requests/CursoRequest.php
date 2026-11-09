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
        return [
            'Año' => 'required|integer|min:2000|max:2100',
            'Id_grado' => 'required|integer|exists:grado,Id_Grado',
            'Id_docente' => 'required|integer|exists:docente,Id_Docente',
        ];
    }
}