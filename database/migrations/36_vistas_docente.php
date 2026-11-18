<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Vista 1: Perfil Integral del Docente (Cruzando usuario y profesión)
        DB::statement("
            CREATE OR REPLACE VIEW vista_docente_perfil AS
            SELECT 
                d.id_docente AS docente_id,
                u.id_usuario AS usuario_id,
                u.nombre AS docente_nombre,
                u.apellido AS docente_apellido,
                u.correo AS docente_correo,
                u.telefono AS docente_telefono,
                p.nombre_profesion AS profesion_nombre
            FROM docente d
            LEFT JOIN usuarios u ON d.id_usuario = u.id_usuario
            LEFT JOIN profesion p ON d.id_profesion = p.id_profesion;
        ");

        // Vista 2: Asignación Académica (Docentes por horario/materia si aplica)
        DB::statement("
            CREATE OR REPLACE VIEW vista_docente_asignacion AS
            SELECT 
                d.id_docente AS docente_id,
                u.nombre AS docente_nombre,
                u.apellido AS docente_apellido,
                COUNT(h.id_horario) AS total_clases_asignadas
            FROM docente d
            LEFT JOIN usuarios u ON d.id_usuario = u.id_usuario
            LEFT JOIN horario_academico h ON h.id_docente = d.id_docente
            GROUP BY d.id_docente, u.nombre, u.apellido;
        ");

        // Vista 3: Resumen del Personal Docente
        DB::statement("
            CREATE OR REPLACE VIEW vista_docente_resumen AS
            SELECT 
                d.id_docente AS docente_id,
                u.nombre || ' ' || u.apellido AS nombre_completo,
                u.correo AS correo_contacto
            FROM docente d
            LEFT JOIN usuarios u ON d.id_usuario = u.id_usuario
            ORDER BY u.apellido ASC;
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_docente_resumen;");
        DB::statement("DROP VIEW IF EXISTS vista_docente_asignacion;");
        DB::statement("DROP VIEW IF EXISTS vista_docente_perfil;");
    }
};