<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrupoSanguineoSeeder extends Seeder
{
    public function run(): void
    {
        $grupos = [
            ['Grupo' => 'A', 'RH' => 'POSITIVO'],
            ['Grupo' => 'A', 'RH' => 'NEGATIVO'],
            ['Grupo' => 'B', 'RH' => 'POSITIVO'],
            ['Grupo' => 'B', 'RH' => 'NEGATIVO'],
            ['Grupo' => 'AB', 'RH' => 'POSITIVO'],
            ['Grupo' => 'AB', 'RH' => 'NEGATIVO'],
            ['Grupo' => 'O', 'RH' => 'POSITIVO'],
            ['Grupo' => 'O', 'RH' => 'NEGATIVO']
        ];

        foreach ($grupos as $grupo) {
            DB::table('grupo_sanguineo')->updateOrInsert(
                $grupo,
                $grupo
            );
        }
    }
}
