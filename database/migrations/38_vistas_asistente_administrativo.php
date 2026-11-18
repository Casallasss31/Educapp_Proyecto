<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Vista 1: Perfil de Asistencia Administrativa
        DB::statement("
            CREATE OR REPLACE VIEW vista_asistente_perfil AS
            SELECT 
                aa.id_asistente AS asistente_id,
                u.id_usuario AS usuario_id,
                u.nombre AS asistente_nombre,
                u.apellido AS asistente_apellido,
                u.correo AS asistente_correo,
                u.telefono AS asistente_telefono
            FROM asistente_administrativo aa
            LEFT JOIN usuarios u ON aa.id_usuario = u.id_usuario;
        ");

        // Vista 2: Control Operativo de Personal de Apoyo
        DB::statement("
            CREATE OR REPLACE VIEW vista_asistente_operativo AS
            SELECT 
                aa.id_asistente AS asistente_id,
                u.nombre || ' ' || u.apellido AS nombre_completo,
                u.correo AS correo
            FROM asistente_administrativo aa
            LEFT JOIN usuarios u ON aa.id_usuario = u.id_usuario;
        ");

        // Vista 3: Resumen General
        DB::statement("
            CREATE OR REPLACE VIEW vista_asistente_resumen AS
            SELECT 
                id_asistente AS asistente_id,
                id_usuario AS usuario_id
            FROM asistente_administrativo;
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_asistente_resumen;");
        DB::statement("DROP VIEW IF EXISTS vista_asistente_operativo;");
        DB::statement("DROP VIEW IF EXISTS vista_asistente_perfil;");
    }
};