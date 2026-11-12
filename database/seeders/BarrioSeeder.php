<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarrioSeeder extends Seeder
{
    public function run(): void
    {
        $barrios = [
            [
                'Estrato' => 2,
                'Nombre_Barrio' => 'Barrio Prueba San Cristóbal',
                'Direccion' => 'Calle 10 # 10-10',
                'Id_localidad' => 4
            ],
            [
                'Estrato' => 2,
                'Nombre_Barrio' => 'Barrio Prueba Ciudad Bolívar',
                'Direccion' => 'Carrera 20 # 20-20',
                'Id_localidad' => 19
            ]
        ];

        foreach ($barrios as $barrio) {
            DB::table('barrio')->updateOrInsert(
                ['Nombre_Barrio' => $barrio['Nombre_Barrio']],
                $barrio
            );
        }
    }
}