<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Vista 1: Catálogo Completo de EPS
        DB::statement("
            CREATE OR REPLACE VIEW vista_eps_catalogo AS
            SELECT 
                id_eps AS eps_id,
                nombre_eps AS eps_nombre
            FROM eps;
        ");

        // Vista 2: Demográfica por EPS (Afiliados)
        DB::statement("
            CREATE OR REPLACE VIEW vista_eps_demografia AS
            SELECT 
                e.id_eps AS eps_id,
                e.nombre_eps AS eps_nombre,
                COUNT(u.id_usuario) AS total_afiliados
            FROM eps e
            LEFT JOIN usuarios u ON u.id_eps = e.id_eps
            GROUP BY e.id_eps, e.nombre_eps;
        ");

        // Vista 3: Cobertura de Salud (EPS con o sin representación)
        DB::statement("
            CREATE OR REPLACE VIEW vista_eps_cobertura AS
            SELECT 
                e.id_eps AS eps_id,
                e.nombre_eps AS eps_nombre,
                CASE 
                    WHEN COUNT(u.id_usuario) = 0 THEN 'Sin afiliados registrados'
                    ELSE 'Con cobertura activa'
                END AS estado_cobertura
            FROM eps e
            LEFT JOIN usuarios u ON u.id_eps = e.id_eps
            GROUP BY e.id_eps, e.nombre_eps;
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_eps_cobertura;");
        DB::statement("DROP VIEW IF EXISTS vista_eps_demografia;");
        DB::statement("DROP VIEW IF EXISTS vista_eps_catalogo;");
    }
};