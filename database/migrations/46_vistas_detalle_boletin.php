<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Vista 1: Detalle de Calificaciones (Cruzando boletín, materia y nota)
        DB::statement("
            CREATE OR REPLACE VIEW vista_detalle_boletin_integral AS
            SELECT 
                db.id_detalle_boletin AS detalle_boletin_id,
                b.id_boletin AS boletin_id,
                u.nombre || ' ' || u.apellido AS estudiante_nombre_completo,
                m.nombre_materia AS materia_nombre,
                n.calificacion AS nota_obtenida,
                db.observaciones AS observaciones_academicas
            FROM detalle_boletin db
            LEFT JOIN boletin b ON db.id_boletin = b.id_boletin
            LEFT JOIN estudiante e ON b.id_estudiante = e.id_estudiante
            LEFT JOIN usuarios u ON e.id_usuario = u.id_usuario
            LEFT JOIN materia m ON db.id_materia = m.id_materia
            LEFT JOIN nota n ON db.id_nota = n.id_nota;
        ");

        // Vista 2: Análisis de Desempeño por Materia
        DB::statement("
            CREATE OR REPLACE VIEW vista_detalle_boletin_analisis AS
            SELECT 
                m.id_materia AS materia_id,
                m.nombre_materia AS materia_nombre,
                COUNT(db.id_detalle_boletin) AS total_evaluaciones_registradas
            FROM detalle_boletin db
            LEFT JOIN materia m ON db.id_materia = m.id_materia
            GROUP BY m.id_materia, m.nombre_materia;
        ");

        // Vista 3: Consolidado Académico de Auditoría
        DB::statement("
            CREATE OR REPLACE VIEW vista_detalle_boletin_resumen AS
            SELECT 
                id_detalle_boletin AS detalle_boletin_id,
                id_boletin AS boletin_id,
                id_materia AS materia_id,
                id_nota AS nota_id
            FROM detalle_boletin
            ORDER BY id_detalle_boletin ASC;
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_detalle_boletin_resumen;");
        DB::statement("DROP VIEW IF EXISTS vista_detalle_boletin_analisis;");
        DB::statement("DROP VIEW IF EXISTS vista_detalle_boletin_integral;");
    }
};