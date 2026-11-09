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
        return [
            'Nombre_Materia' => 'required|string|max:100',
            'Id_area' => 'required|integer|exists:area,Id_Area',
            'Id_nota' => 'required|integer|exists:nota,Id_Nota',
        ];
    }
}