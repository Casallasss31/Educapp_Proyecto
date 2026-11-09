<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Nombres' => 'required|string|max:100',
            'Apellidos' => 'required|string|max:100',
            'Tipo_Documento' => 'required|string|max:30',
            'Numero_Documento' => 'required|integer',
            'Fecha_Nacimiento' => 'required|date',
            'Genero' => 'required|in:Masculino,Femenino',
            'Id_Rol' => 'required|integer|exists:rol,Id_Rol',
            'Id_EPS' => 'required|integer|exists:eps,Id_EPS',
            'Id_Grupo_Sanguineo' => 'required|integer|exists:grupo_sanguineo,Id_GRUPO_SANGUINEO',
            'Id_Barrio' => 'required|integer|exists:barrio,Id_Barrio',
        ];
    }
}