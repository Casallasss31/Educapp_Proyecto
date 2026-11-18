<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Vista 1: Maestra de Factores Rh
        DB::statement("
            CREATE OR REPLACE VIEW vista_grupo_sanguineo_maestra AS
            SELECT 
                id_grupo_sanguineo AS grupo_id,
                tipo_sangre AS factor_rh
            FROM grupo_sanguineo;
        ");

        // Vista 2: Estadística de Emergencia (Usuarios por tipo de sangre)
        DB::statement("
            CREATE OR REPLACE VIEW vista_grupo_sanguineo_estadistica AS
            SELECT 
                gs.id_grupo_sanguineo AS grupo_id,
                gs.tipo_sangre AS factor_rh,
                COUNT(u.id_usuario) AS total_usuarios
            FROM grupo_sanguineo gs
            LEFT JOIN usuarios u ON u.id_grupo_sanguineo = gs.id_grupo_sanguineo
            GROUP BY gs.id_grupo_sanguineo, gs.tipo_sangre;
        ");

        // Vista 3: Grupos Críticos / Distribución general
        DB::statement("
            CREATE OR REPLACE VIEW vista_grupo_sanguineo_criticos AS
            SELECT 
                gs.id_grupo_sanguineo AS grupo_id,
                gs.tipo_sangre AS factor_rh,
                COUNT(u.id_usuario) AS cantidad_personas
            FROM grupo_sanguineo gs
            LEFT JOIN usuarios u ON u.id_grupo_sanguineo = gs.id_grupo_sanguineo
            GROUP BY gs.id_grupo_sanguineo, gs.tipo_sangre
            ORDER BY cantidad_personas DESC;
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_grupo_sanguineo_criticos;");
        DB::statement("DROP VIEW IF EXISTS vista_grupo_sanguineo_estadistica;");
        DB::statement("DROP VIEW IF EXISTS vista_grupo_sanguineo_maestra;");
    }
};