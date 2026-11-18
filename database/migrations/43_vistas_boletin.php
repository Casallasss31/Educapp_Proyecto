<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Vista 1: Boletín Académico General (Cruzando con estudiante y curso)
        DB::statement("
            CREATE OR REPLACE VIEW vista_boletin_detalle AS
            SELECT 
                b.id_boletin AS boletin_id,
                u.nombre || ' ' || u.apellido AS estudiante_nombre_completo,
                cs.nombre_curso AS curso_nombre,
                b.periodo AS periodo_academico
            FROM boletin b
            LEFT JOIN estudiante e ON b.id_estudiante = e.id_estudiante
            LEFT JOIN usuarios u ON e.id_usuario = u.id_usuario
            LEFT JOIN curso cs ON b.id_curso = cs.id_curso;
        ");

        // Vista 2: Conteo de Detalles de Evaluación por Boletín
        DB::statement("
            CREATE OR REPLACE VIEW vista_boletin_rendimiento AS
            SELECT 
                b.id_boletin AS boletin_id,
                b.periodo AS periodo_academico,
                COUNT(db.id_detalle_boletin) AS total_materias_evaluadas
            FROM boletin b
            LEFT JOIN detalle_boletin db ON db.id_boletin = b.id_boletin
            GROUP BY b.id_boletin, b.periodo;
        ");

        // Vista 3: Resumen Cronológico de Boletines
        DB::statement("
            CREATE OR REPLACE VIEW vista_boletin_resumen AS
            SELECT 
                id_boletin AS boletin_id,
                id_estudiante AS estudiante_id,
                id_curso AS curso_id,
                periodo AS periodo_academico
            FROM boletin
            ORDER BY periodo ASC;
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_boletin_resumen;");
        DB::statement("DROP VIEW IF EXISTS vista_boletin_rendimiento;");
        DB::statement("DROP VIEW IF EXISTS vista_boletin_detalle;");
    }
};