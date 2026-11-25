<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Vista 1: Georreferenciación Cruzada (Barrio con su Localidad)
        DB::statement("
            CREATE OR REPLACE VIEW vista_barrio_localidad AS
            SELECT 
                b.id_barrio AS barrio_id,
                b.nombre_barrio AS barrio_nombre,
                l.id_localidad AS localidad_id,
                l.nombre_localidad AS localidad_nombre
            FROM barrio b
            LEFT JOIN localidad l ON b.id_localidad = l.id_localidad;
        ");

        // Vista 2: Concentración de Usuarios por Barrio
        DB::statement("
            CREATE OR REPLACE VIEW vista_barrio_usuarios AS
            SELECT 
                b.id_barrio AS barrio_id,
                b.nombre_barrio AS barrio_nombre,
                COUNT(u.id_usuario) AS total_usuarios
            FROM barrio b
            LEFT JOIN usuarios u ON u.id_barrio = b.id_barrio
            GROUP BY b.id_barrio, b.nombre_barrio;
        ");

        // Vista 3: Mapeo Logístico General
        DB::statement("
            CREATE OR REPLACE VIEW vista_barrio_resumen AS
            SELECT 
                id_barrio AS barrio_id,
                nombre_barrio AS barrio_nombre
            FROM barrio
            ORDER BY nombre_barrio ASC;
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_barrio_resumen;");
        DB::statement("DROP VIEW IF EXISTS vista_barrio_usuarios;");
        DB::statement("DROP VIEW IF EXISTS vista_barrio_localidad;");
    }
};