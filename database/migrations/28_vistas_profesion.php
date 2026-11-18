<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Vista 1: Catálogo de Perfiles
        DB::statement("
            CREATE OR REPLACE VIEW vista_profesion_catalogo AS
            SELECT 
                id_profesion AS profesion_id,
                nombre_profesion AS profesion_nombre
            FROM profesion;
        ");

        // Vista 2: Asociación Laboral (Docentes o administrativos asociados a la profesión)
        DB::statement("
            CREATE OR REPLACE VIEW vista_profesion_asociacion AS
            SELECT 
                p.id_profesion AS profesion_id,
                p.nombre_profesion AS profesion_nombre,
                COUNT(d.id_docente) AS total_docentes
            FROM profesion p
            LEFT JOIN docente d ON d.id_profesion = p.id_profesion
            GROUP BY p.id_profesion, p.nombre_profesion;
        ");

        // Vista 3: Diversidad Académica (Orden alfabético de profesiones)
        DB::statement("
            CREATE OR REPLACE VIEW vista_profesion_resumen AS
            SELECT 
                id_profesion AS profesion_id,
                nombre_profesion AS profesion_nombre
            FROM profesion
            ORDER BY nombre_profesion ASC;
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_profesion_resumen;");
        DB::statement("DROP VIEW IF EXISTS vista_profesion_asociacion;");
        DB::statement("DROP VIEW IF EXISTS vista_profesion_catalogo;");
    }
};