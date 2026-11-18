<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Vista 1: Programación de Clases (Cruzando curso, materia y docente)
        DB::statement("
            CREATE OR REPLACE VIEW vista_horario_detalle AS
            SELECT 
                h.id_horario AS horario_id,
                c.nombre_curso AS curso_nombre,
                m.nombre_materia AS materia_nombre,
                u.nombre || ' ' || u.apellido AS docente_nombre_completo,
                h.dia AS dia_semana,
                h.hora_inicio AS hora_inicio,
                h.hora_fin AS hora_fin
            FROM horario_academico h
            LEFT JOIN curso c ON h.id_curso = c.id_curso
            LEFT JOIN materia m ON h.id_materia = m.id_materia
            LEFT JOIN docente d ON h.id_docente = d.id_docente
            LEFT JOIN usuarios u ON d.id_usuario = u.id_usuario;
        ");

        // Vista 2: Distribución por Día de la Semana
        DB::statement("
            CREATE OR REPLACE VIEW vista_horario_distribucion AS
            SELECT 
                h.dia AS dia_semana,
                COUNT(h.id_horario) AS total_clases_programadas
            FROM horario_academico h
            GROUP BY h.dia;
        ");

        // Vista 3: Resumen Logístico de Horarios
        DB::statement("
            CREATE OR REPLACE VIEW vista_horario_resumen AS
            SELECT 
                id_horario AS horario_id,
                id_curso AS curso_id,
                id_materia AS materia_id,
                dia AS dia_semana
            FROM horario_academico
            ORDER BY dia ASC;
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_horario_resumen;");
        DB::statement("DROP VIEW IF EXISTS vista_horario_distribucion;");
        DB::statement("DROP VIEW IF EXISTS vista_horario_detalle;");
    }
};