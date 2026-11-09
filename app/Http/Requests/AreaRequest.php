<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AreaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Nombre_Area' => 'required|string|max:100',
            'Descripcion_Area' => 'nullable|string|max:255',
        ];
    }
}