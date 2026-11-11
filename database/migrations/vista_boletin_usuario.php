<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
 {
        DB::statement("
            CREATE OR REPLACE VIEW vista_boletin_usuario AS
            SELECT
                b.id            AS boletin_id,
                u.id            AS usuario_id,
                u.nombre          AS usuario,
                r.nombre       AS rol,
                c.nombre        AS curso,
                b.periodo,
                b.nota
            FROM boletin
            INNER JOIN usuarios u ON u.id = b.usuario_id
            LEFT JOIN  roles  r ON r.id = u.rol_id
            LEFT JOIN  cursos c ON c.id = b.curso_id
        ");
    }


    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_boletin_usuario");
    }
};
