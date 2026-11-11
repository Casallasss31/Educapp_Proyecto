<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW vista_docentes AS
            SELECT
                d.id_docente AS id_docente,
                u.username,
                u.name AS docente,
                p.nombre AS profesion,
                c.id_curso AS curso_id,
                c.nombre AS curso
            FROM docentes d
            INNER JOIN users u ON u.id = d.id_usuario
            LEFT JOIN profesiones p ON p.id = d.id_profesion
            LEFT JOIN cursos c ON c.id_docente = d.id_docente
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vista_docentes');
    }
};