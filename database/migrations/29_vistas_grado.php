<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Vista 1: Estructura Académica
        DB::statement("
            CREATE OR REPLACE VIEW vista_grado_catalogo AS
            SELECT 
                id_grado AS grado_id,
                nombre_grado AS grado_nombre
            FROM grado;
        ");

        // Vista 2: Capacidad Estudiantil (Cursos asociados por grado)
        DB::statement("
            CREATE OR REPLACE VIEW vista_grado_cursos AS
            SELECT 
                g.id_grado AS grado_id,
                g.nombre_grado AS grado_nombre,
                COUNT(c.id_curso) AS total_cursos
            FROM grado g
            LEFT JOIN curso c ON c.id_grado = g.id_grado
            GROUP BY g.id_grado, g.nombre_grado;
        ");

        // Vista 3: Jerarquía de Grados
        DB::statement("
            CREATE OR REPLACE VIEW vista_grado_resumen AS
            SELECT 
                id_grado AS grado_id,
                nombre_grado AS grado_nombre
            FROM grado
            ORDER BY id_grado ASC;
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_grado_resumen;");
        DB::statement("DROP VIEW IF EXISTS vista_grado_cursos;");
        DB::statement("DROP VIEW IF EXISTS vista_grado_catalogo;");
    }
};