<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Vista 1: Escala de Calificación
        DB::statement("
            CREATE OR REPLACE VIEW vista_nota_catalogo AS
            SELECT 
                id_nota AS nota_id,
                calificacion AS nota_calificacion
            FROM nota;
        ");

        // Vista 2: Distribución de Rendimiento en boletines
        DB::statement("
            CREATE OR REPLACE VIEW vista_nota_distribucion AS
            SELECT 
                n.id_nota AS nota_id,
                n.calificacion AS nota_calificacion,
                COUNT(db.id_detalle_boletin) AS total_registros_asociados
            FROM nota n
            LEFT JOIN detalle_boletin db ON db.id_nota = n.id_nota
            GROUP BY n.id_nota, n.calificacion;
        ");

        // Vista 3: Historial Analítico General
        DB::statement("
            CREATE OR REPLACE VIEW vista_nota_resumen AS
            SELECT 
                id_nota AS nota_id,
                calificacion AS nota_calificacion
            FROM nota
            ORDER BY id_nota ASC;
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_nota_resumen;");
        DB::statement("DROP VIEW IF EXISTS vista_nota_distribucion;");
        DB::statement("DROP VIEW IF EXISTS vista_nota_catalogo;");
    }
};