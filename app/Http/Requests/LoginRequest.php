<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Correo' => 'required|email',
            'password' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'Correo.required' => 'El correo es obligatorio.',
            'Correo.email' => 'El correo no es válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ];
    }
}