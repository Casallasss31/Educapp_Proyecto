<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Vista 1: Emisión de Certificados (Cruzando con estudiante y tipo)
        DB::statement("
            CREATE OR REPLACE VIEW vista_certificado_detalle AS
            SELECT 
                c.id_certificado AS certificado_id,
                tc.nombre_certificado AS tipo_certificado,
                u.nombre || ' ' || u.apellido AS estudiante_nombre_completo,
                c.created_at AS fecha_emision
            FROM certificado c
            LEFT JOIN tipo_certificado tc ON c.id_tipo_certificado = tc.id_tipo_certificado
            LEFT JOIN estudiante e ON c.id_estudiante = e.id_estudiante
            LEFT JOIN usuarios u ON e.id_usuario = u.id_usuario;
        ");

        // Vista 2: Demanda de Trámites por Estudiante
        DB::statement("
            CREATE OR REPLACE VIEW vista_certificado_conteo AS
            SELECT 
                e.id_estudiante AS estudiante_id,
                u.nombre || ' ' || u.apellido AS estudiante_nombre_completo,
                COUNT(c.id_certificado) AS total_certificados_solicitados
            FROM estudiante e
            LEFT JOIN usuarios u ON e.id_usuario = u.id_usuario
            LEFT JOIN certificado c ON c.id_estudiante = e.id_estudiante
            GROUP BY e.id_estudiante, u.nombre, u.apellido;
        ");

        // Vista 3: Historial Documental General
        DB::statement("
            CREATE OR REPLACE VIEW vista_certificado_resumen AS
            SELECT 
                id_certificado AS certificado_id,
                id_estudiante AS estudiante_id,
                id_tipo_certificado AS tipo_id
            FROM certificado
            ORDER BY id_certificado DESC;
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_certificado_resumen;");
        DB::statement("DROP VIEW IF EXISTS vista_certificado_conteo;");
        DB::statement("DROP VIEW IF EXISTS vista_certificado_detalle;");
    }
};