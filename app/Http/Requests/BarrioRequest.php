<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarrioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Estrato' => 'required|integer|between:1,6',
            'Nombre_Barrio' => 'required|string|max:100',
            'Direccion' => 'required|string|max:150',
            'Id_localidad' => 'required|integer|exists:localidad,Id_Localidad',
        ];
    }
}