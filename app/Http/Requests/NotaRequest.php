<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Valor_Nota' => [
                'required',
                'numeric',
                'min:1',
                'max:5',
                'decimal:0,1'
            ],

            'Nombre_Nota' => [
                'prohibited'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'Valor_Nota.required' =>
                'El valor de la nota es obligatorio.',

            'Valor_Nota.numeric' =>
                'La nota debe ser un valor numerico.',

            'Valor_Nota.min' =>
                'La nota minima permitida es 1.0.',

            'Valor_Nota.max' =>
                'La nota maxima permitida es 5.0.',

            'Valor_Nota.decimal' =>
                'La nota solo puede tener un decimal.',

            'Nombre_Nota.prohibited' =>
                'El nombre de la nota se genera automaticamente.'
        ];
    }
}