<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Vista 1: Malla Curricular (Cruzando con el área de conocimiento)
        DB::statement("
            CREATE OR REPLACE VIEW vista_materia_detalle AS
            SELECT 
                m.id_materia AS materia_id,
                m.nombre_materia AS materia_nombre,
                a.id_area AS area_id,
                a.nombre_area AS area_nombre
            FROM materia m
            LEFT JOIN area a ON m.id_area = a.id_area;
        ");

        // Vista 2: Control Operativo de Asignaturas
        DB::statement("
            CREATE OR REPLACE VIEW vista_materia_asignacion AS
            SELECT 
                m.id_materia AS materia_id,
                m.nombre_materia AS materia_nombre,
                a.nombre_area AS area_nombre,
                COUNT(db.id_detalle_boletin) AS total_calificaciones_registradas
            FROM materia m
            LEFT JOIN area a ON m.id_area = a.id_area
            LEFT JOIN detalle_boletin db ON db.id_materia = m.id_materia
            GROUP BY m.id_materia, m.nombre_materia, a.nombre_area;
        ");

        // Vista 3: Catálogo General Ordenado
        DB::statement("
            CREATE OR REPLACE VIEW vista_materia_resumen AS
            SELECT 
                m.id_materia AS materia_id,
                m.nombre_materia AS materia_nombre,
                a.nombre_area AS area_nombre
            FROM materia m
            LEFT JOIN area a ON m.id_area = a.id_area
            ORDER BY m.nombre_materia ASC;
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_materia_resumen;");
        DB::statement("DROP VIEW IF EXISTS vista_materia_asignacion;");
        DB::statement("DROP VIEW IF EXISTS vista_materia_detalle;");
    }
};