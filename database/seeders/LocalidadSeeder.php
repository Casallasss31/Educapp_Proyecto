<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalidadSeeder extends Seeder
{
    public function run(): void
    {
        $localidades = [
            [
                'Id_Localidad' => 4,
                'Nombre_Localidad' => 'San Cristóbal'
            ],
            [
                'Id_Localidad' => 19,
                'Nombre_Localidad' => 'Ciudad Bolívar'
            ]
        ];

        foreach ($localidades as $localidad) {
            DB::table('localidad')->updateOrInsert(
                ['Id_Localidad' => $localidad['Id_Localidad']],
                $localidad
            );
        }
    }
}