<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RectorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Numero_Telefono' => 'nullable|integer',
            'Correo' => 'required|email|max:150',
            'Id_usuario' => 'required|integer|exists:usuarios,Id_usuario',
            'Id_profesion' => 'required|integer|exists:profesion,Id_Profesion',
        ];
    }
}