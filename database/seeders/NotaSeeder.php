<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotaSeeder extends Seeder
{
    public function run(): void
    {
        $notas = [
            'Superior',
            'Alto',
            'Básico',
            'Bajo'
        ];

        foreach ($notas as $nota) {
            DB::table('nota')->updateOrInsert(
                ['Nombre_Nota' => $nota],
                ['Nombre_Nota' => $nota]
            );
        }
    }
}
