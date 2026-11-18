<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Vista 1: Detalle Enriquecido del Rol
        DB::statement("
            CREATE OR REPLACE VIEW vista_rol_detalle AS
            SELECT 
                id_rol AS rol_id,
                nombre_rol AS rol_nombre,
                descripcion AS rol_descripcion
            FROM rol;
        ");

        // Vista 2: Conteo Operativo (Usuarios por Rol)
        DB::statement("
            CREATE OR REPLACE VIEW vista_rol_conteo_usuarios AS
            SELECT 
                r.id_rol AS rol_id,
                r.nombre_rol AS rol_nombre,
                COUNT(u.id_usuario) AS total_usuarios
            FROM rol r
            LEFT JOIN usuarios u ON u.id_rol = r.id_rol
            GROUP BY r.id_rol, r.nombre_rol;
        ");

        // Vista 3: Resumen Administrativo (Clasificación básica)
        DB::statement("
            CREATE OR REPLACE VIEW vista_rol_resumen AS
            SELECT 
                id_rol,
                nombre_rol,
                CASE 
                    WHEN LOWER(nombre_rol) LIKE '%admin%' OR LOWER(nombre_rol) LIKE '%rector%' THEN 'Directivo / Alto'
                    ELSE 'Operativo / Estándar'
                END AS nivel_acceso
            FROM rol;
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_rol_resumen;");
        DB::statement("DROP VIEW IF EXISTS vista_rol_conteo_usuarios;");
        DB::statement("DROP VIEW IF EXISTS vista_rol_detalle;");
    }
};