<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Vista 1: Catálogo de Trámites
        DB::statement("
            CREATE OR REPLACE VIEW vista_tipo_certificado_catalogo AS
            SELECT 
                id_tipo_certificado AS tipo_certificado_id,
                nombre_certificado AS tipo_certificado_nombre
            FROM tipo_certificado;
        ");

        // Vista 2: Demanda de Certificados (Solicitudes asociadas)
        DB::statement("
            CREATE OR REPLACE VIEW vista_tipo_certificado_demanda AS
            SELECT 
                tc.id_tipo_certificado AS tipo_certificado_id,
                tc.nombre_certificado AS tipo_certificado_nombre,
                COUNT(c.id_certificado) AS total_emitidos
            FROM tipo_certificado tc
            LEFT JOIN certificado c ON c.id_tipo_certificado = tc.id_tipo_certificado
            GROUP BY tc.id_tipo_certificado, tc.nombre_certificado;
        ");

        // Vista 3: Clasificación de Documentos
        DB::statement("
            CREATE OR REPLACE VIEW vista_tipo_certificado_resumen AS
            SELECT 
                id_tipo_certificado AS tipo_certificado_id,
                nombre_certificado AS tipo_certificado_nombre
            FROM tipo_certificado
            ORDER BY nombre_certificado ASC;
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_tipo_certificado_resumen;");
        DB::statement("DROP VIEW IF EXISTS vista_tipo_certificado_demanda;");
        DB::statement("DROP VIEW IF EXISTS vista_tipo_certificado_catalogo;");
    }
};