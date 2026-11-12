<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'RECTOR',
            'ASISTENTE ADMINISTRATIVO',
            'ESTUDIANTE',
            'ACUDIENTE',
            'DOCENTE'
        ];

        foreach ($roles as $rol) {
            DB::table('rol')->updateOrInsert(
                ['Tipo' => $rol],
                ['Tipo' => $rol]
            );
        }
    }
}