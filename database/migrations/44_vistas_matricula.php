<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Vista 1: Proceso de Matrícula Detallado (Cruzando estudiante y curso)
        DB::statement("
            CREATE OR REPLACE VIEW vista_matricula_detalle AS
            SELECT 
                m.id_matricula AS matricula_id,
                u.nombre || ' ' || u.apellido AS estudiante_nombre_completo,
                c.nombre_curso AS curso_nombre,
                m.estado AS matricula_estado,
                m.created_at AS fecha_matricula
            FROM matricula m
            LEFT JOIN estudiante e ON m.id_estudiante = e.id_estudiante
            LEFT JOIN usuarios u ON e.id_usuario = u.id_usuario
            LEFT JOIN curso c ON m.id_curso = c.id_curso;
        ");

        // Vista 2: Conteo y Estadísticas por Estado de Matrícula
        DB::statement("
            CREATE OR REPLACE VIEW vista_matricula_estadistica AS
            SELECT 
                m.estado AS matricula_estado,
                COUNT(m.id_matricula) AS total_estudiantes
            FROM matricula m
            GROUP BY m.estado;
        ");

        // Vista 3: Resumen Académico de Matrículas
        DB::statement("
            CREATE OR REPLACE VIEW vista_matricula_resumen AS
            SELECT 
                id_matricula AS matricula_id,
                id_estudiante AS estudiante_id,
                id_curso AS curso_id,
                estado AS matricula_estado
            FROM matricula
            ORDER BY id_matricula DESC;
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_matricula_resumen;");
        DB::statement("DROP VIEW IF EXISTS vista_matricula_estadistica;");
        DB::statement("DROP VIEW IF EXISTS vista_matricula_detalle;");
    }
};