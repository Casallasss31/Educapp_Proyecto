<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetalleBoletinRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Fallas' => 'nullable|integer|min:0',
            'Id_docentes' => 'nullable|integer|exists:docente,Id_Docente',
            'Id_boletin' => 'nullable|integer|exists:boletin,Id_Boletin',
        ];
    }
}
