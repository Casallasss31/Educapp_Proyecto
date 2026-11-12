<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    public function run(): void
    {
        $areas = [
            [
                'Nombre_Area' => 'Matemáticas',
                'Descripcion_Area' => 'Área de pensamiento matemático'
            ],
            [
                'Nombre_Area' => 'Ciencias Naturales',
                'Descripcion_Area' => 'Área de ciencias naturales y educación ambiental'
            ],
            [
                'Nombre_Area' => 'Humanidades',
                'Descripcion_Area' => 'Área de lenguaje e idiomas'
            ],
            [
                'Nombre_Area' => 'Ciencias Sociales',
                'Descripcion_Area' => 'Área de historia y ciencias sociales'
            ],
            [
                'Nombre_Area' => 'Tecnología e Informática',
                'Descripcion_Area' => 'Área de tecnología e informática'
            ]
        ];

        foreach ($areas as $area) {
            DB::table('area')->updateOrInsert(
                ['Nombre_Area' => $area['Nombre_Area']],
                $area
            );
        }
    }
}