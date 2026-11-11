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
                b.id_boletin           AS boletin_id,
                u.id_usuario           AS usuario_id,
                u.nombres              AS usuario,
                r.nombre               AS rol,
                c.nombre               AS curso,
                b.periodo,
                b.nota
            FROM boletin
            INNER JOIN usuarios u ON u.id_usuario = b.usuario_id
            LEFT JOIN  roles  r ON r.id_rol = u.rol
            LEFT JOIN  cursos c ON c.id_curso = b.curso_id
        ");
    }


    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_boletin_usuario");
    }
};
