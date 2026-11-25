<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Vista 1: Jerárquica (Localidad con su conteo de barrios)
        DB::statement("
            CREATE OR REPLACE VIEW vista_localidad_barrios AS
            SELECT 
                l.id_localidad AS localidad_id,
                l.nombre_localidad AS localidad_nombre,
                COUNT(b.id_barrio) AS total_barrios
            FROM localidad l
            LEFT JOIN barrio b ON b.id_localidad = l.id_localidad
            GROUP BY l.id_localidad, l.nombre_localidad;
        ");

        // Vista 2: Distribución Poblacional (Usuarios por localidad a través de barrios)
        DB::statement("
            CREATE OR REPLACE VIEW vista_localidad_poblacion AS
            SELECT 
                l.id_localidad AS localidad_id,
                l.nombre_localidad AS localidad_nombre,
                COUNT(u.id_usuario) AS total_usuarios
            FROM localidad l
            LEFT JOIN barrio b ON b.id_localidad = l.id_localidad
            LEFT JOIN usuarios u ON u.id_barrio = b.id_barrio
            GROUP BY l.id_localidad, l.nombre_localidad;
        ");

        // Vista 3: Resumen Geográfico Ordenado
        DB::statement("
            CREATE OR REPLACE VIEW vista_localidad_resumen AS
            SELECT 
                id_localidad AS localidad_id,
                nombre_localidad AS localidad_nombre
            FROM localidad
            ORDER BY nombre_localidad ASC;
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_localidad_resumen;");
        DB::statement("DROP VIEW IF EXISTS vista_localidad_poblacion;");
        DB::statement("DROP VIEW IF EXISTS vista_localidad_barrios;");
    }
};