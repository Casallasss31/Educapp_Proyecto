<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Vista 1: Estructura del Curso (Cruzando con Grado)
        DB::statement("
            CREATE OR REPLACE VIEW vista_curso_detalle AS
            SELECT 
                c.id_curso AS curso_id,
                c.nombre_curso AS curso_nombre,
                g.id_grado AS grado_id,
                g.nombre_grado AS grado_nombre
            FROM curso c
            LEFT JOIN grado g ON c.id_grado = g.id_grado;
        ");

        // Vista 2: Población Estudiantil por Curso (Conteo de cupos/matrículas)
        DB::statement("
            CREATE OR REPLACE VIEW vista_curso_estudiantes AS
            SELECT 
                c.id_curso AS curso_id,
                c.nombre_curso AS curso_nombre,
                g.nombre_grado AS grado_nombre,
                COUNT(m.id_matricula) AS total_estudiantes_matriculados
            FROM curso c
            LEFT JOIN grado g ON c.id_grado = g.id_grado
            LEFT JOIN matricula m ON m.id_curso = c.id_curso
            GROUP BY c.id_curso, c.nombre_curso, g.nombre_grado;
        ");

        // Vista 3: Oferta Académica Ordenada
        DB::statement("
            CREATE OR REPLACE VIEW vista_curso_resumen AS
            SELECT 
                c.id_curso AS curso_id,
                c.nombre_curso AS curso_nombre,
                g.nombre_grado AS grado_nombre
            FROM curso c
            LEFT JOIN grado g ON c.id_grado = g.id_grado
            ORDER BY g.id_grado ASC, c.nombre_curso ASC;
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_curso_resumen;");
        DB::statement("DROP VIEW IF EXISTS vista_curso_estudiantes;");
        DB::statement("DROP VIEW IF EXISTS vista_curso_detalle;");
    }
};