<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Vista 1: Áreas de Conocimiento
        DB::statement("
            CREATE OR REPLACE VIEW vista_area_catalogo AS
            SELECT 
                id_area AS area_id,
                nombre_area AS area_nombre
            FROM area;
        ");

        // Vista 2: Asignación Curricular (Materias asociadas a cada área)
        DB::statement("
            CREATE OR REPLACE VIEW vista_area_materias AS
            SELECT 
                a.id_area AS area_id,
                a.nombre_area AS area_nombre,
                COUNT(m.id_materia) AS total_materias
            FROM area a
            LEFT JOIN materia m ON m.id_area = a.id_area
            GROUP BY a.id_area, a.nombre_area;
        ");

        // Vista 3: Carga Académica (Resumen ordenado)
        DB::statement("
            CREATE OR REPLACE VIEW vista_area_resumen AS
            SELECT 
                id_area AS area_id,
                nombre_area AS area_nombre
            FROM area
            ORDER BY nombre_area ASC;
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_area_resumen;");
        DB::statement("DROP VIEW IF EXISTS vista_area_materias;");
        DB::statement("DROP VIEW IF EXISTS vista_area_catalogo;");
    }
};