<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Vista 1: Perfil Directivo
        DB::statement("
            CREATE OR REPLACE VIEW vista_rector_perfil AS
            SELECT 
                r.id_rector AS rector_id,
                u.id_usuario AS usuario_id,
                u.nombre AS rector_nombre,
                u.apellido AS rector_apellido,
                u.correo AS rector_correo,
                u.telefono AS rector_telefono
            FROM rector r
            LEFT JOIN usuarios u ON r.id_usuario = u.id_usuario;
        ");

        // Vista 2: Gestión Institucional (Control operativo)
        DB::statement("
            CREATE OR REPLACE VIEW vista_rector_gestion AS
            SELECT 
                r.id_rector AS rector_id,
                u.nombre || ' ' || u.apellido AS nombre_rector,
                'Activo en funciones directivas' AS estado_gestion
            FROM rector r
            LEFT JOIN usuarios u ON r.id_usuario = u.id_usuario;
        ");

        // Vista 3: Resumen de Autoridad
        DB::statement("
            CREATE OR REPLACE VIEW vista_rector_resumen AS
            SELECT 
                id_rector AS rector_id,
                id_usuario AS usuario_id
            FROM rector;
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_rector_resumen;");
        DB::statement("DROP VIEW IF EXISTS vista_rector_gestion;");
        DB::statement("DROP VIEW IF EXISTS vista_rector_perfil;");
    }
};