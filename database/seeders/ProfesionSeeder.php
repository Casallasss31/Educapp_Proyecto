<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfesionSeeder extends Seeder
{
    public function run(): void
    {
        $profesiones = [
            'Licenciatura en Educación',
            'Ingeniería de Sistemas',
            'Administración de Empresas',
            'Psicología',
            'Contaduría Pública'
        ];

        foreach ($profesiones as $profesion) {
            DB::table('profesion')->updateOrInsert(
                ['Nombre_Profesion' => $profesion],
                ['Nombre_Profesion' => $profesion]
            );
        }
    }
}