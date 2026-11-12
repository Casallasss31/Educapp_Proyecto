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
        $creacion = $this->isMethod('post');

        return [
            'Fallas' => [
                'nullable',
                'integer',
                'min:0'
            ],

            'Id_docentes' => [
                $creacion ? 'required' : 'sometimes',
                'required',
                'integer',
                'exists:docente,Id_Docente'
            ],

            'Id_boletin' => [
                $creacion ? 'required' : 'sometimes',
                'required',
                'integer',
                'exists:boletin,Id_Boletin'
            ],

            'Id_detalle_boletin' => [
                'prohibited'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'Fallas.integer' =>
                'Las fallas deben ser un número entero.',

            'Fallas.min' =>
                'Las fallas no pueden ser negativas.',

            'Id_docentes.required' =>
                'El docente es obligatorio.',

            'Id_docentes.integer' =>
                'El identificador del docente debe ser entero.',

            'Id_docentes.exists' =>
                'El docente seleccionado no existe.',

            'Id_boletin.required' =>
                'El boletín es obligatorio.',

            'Id_boletin.integer' =>
                'El identificador del boletín debe ser entero.',

            'Id_boletin.exists' =>
                'El boletín seleccionado no existe.',

            'Id_detalle_boletin.prohibited' =>
                'No se permite enviar ni modificar el identificador del detalle.'
        ];
    }
}
