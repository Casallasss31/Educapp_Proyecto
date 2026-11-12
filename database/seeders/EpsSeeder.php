<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EpsSeeder extends Seeder
{
    public function run(): void
    {
        $eps = [
            'EPS Prueba EducApp 1',
            'EPS Prueba EducApp 2',
            'EPS Prueba EducApp 3'
        ];

        foreach ($eps as $nombre) {
            DB::table('eps')->updateOrInsert(
                ['Nombre_Eps' => $nombre],
                ['Nombre_Eps' => $nombre]
            );
        }
    }
}