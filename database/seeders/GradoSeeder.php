<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradoSeeder extends Seeder
{
    public function run(): void
    {
        $grados = [
            'Primero',
            'Segundo',
            'Tercero',
            'Cuarto',
            'Quinto',
            'Sexto',
            'Séptimo',
            'Octavo',
            'Noveno',
            'Décimo',
            'Undécimo'
        ];

        foreach ($grados as $grado) {
            DB::table('grado')->updateOrInsert(
                ['Nombre_Grado' => $grado],
                ['Nombre_Grado' => $grado]
            );
        }
    }
}