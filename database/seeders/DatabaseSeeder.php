<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolSeeder::class,
            EpsSeeder::class,
            GrupoSanguineoSeeder::class,
            LocalidadSeeder::class,
            ProfesionSeeder::class,
            GradoSeeder::class,
            AreaSeeder::class,
            NotaSeeder::class,
            TipoCertificadoSeeder::class,
            BarrioSeeder::class
        ]);
    }
}
