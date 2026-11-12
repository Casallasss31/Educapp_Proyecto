<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoCertificadoSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = [
            'Certificado de Estudios',
            'Certificado de Matrícula',
            'Certificado de Notas',
            'Certificado de Comportamiento'
        ];

        foreach ($tipos as $tipo) {
            DB::table('tipo_certificado')->updateOrInsert(
                ['Nombre_Certificado' => $tipo],
                ['Nombre_Certificado' => $tipo]
            );
        }
    }
}