<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Vista 1: Expediente Estudiantil 360° (Cruzando usuario, grado y acudiente)
        DB::statement("
            CREATE OR REPLACE VIEW vista_estudiante_integral AS
            SELECT 
                e.id_estudiante AS estudiante_id,
                u.id_usuario AS usuario_id,
                u.nombre AS estudiante_nombre,
                u.apellido AS estudiante_apellido,
                u.correo AS estudiante_correo,
                u.telefono AS estudiante_telefono,
                g.nombre_grado AS grado_nombre,
                ac_u.nombre || ' ' || ac_u.apellido AS acudiente_nombre_completo
            FROM estudiante e
            LEFT JOIN usuarios u ON e.id_usuario = u.id_usuario
            LEFT JOIN grado g ON e.id_grado = g.id_grado
            LEFT JOIN acudiente ac ON e.id_acudiente = ac.id_acudiente
            LEFT JOIN usuarios ac_u ON ac.id_usuario = ac_u.id_usuario;
        ");

        // Vista 2: Directorio Escolar Activo
        DB::statement("
            CREATE OR REPLACE VIEW vista_estudiante_directorio AS
            SELECT 
                e.id_estudiante AS estudiante_id,
                u.nombre AS estudiante_nombre,
                u.apellido AS estudiante_apellido,
                u.correo AS estudiante_correo,
                u.direccion AS estudiante_direccion
            FROM estudiante e
            LEFT JOIN usuarios u ON e.id_usuario = u.id_usuario;
        ");

        // Vista 3: Estadística Demográfica por Grado
        DB::statement("
            CREATE OR REPLACE VIEW vista_estudiante_estadistica AS
            SELECT 
                g.id_grado AS grado_id,
                g.nombre_grado AS grado_nombre,
                COUNT(e.id_estudiante) AS total_estudiantes
            FROM grado g
            LEFT JOIN estudiante e ON e.id_grado = g.id_grado
            GROUP BY g.id_grado, g.nombre_grado
            ORDER BY g.id_grado ASC;
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_estudiante_estadistica;");
        DB::statement("DROP VIEW IF EXISTS vista_estudiante_directorio;");
        DB::statement("DROP VIEW IF EXISTS vista_estudiante_integral;");
    }
};