<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(<<<SQL
            CREATE OR REPLACE VIEW vista_matricula_usuario AS
            SELECT
                u.Id_usuario        AS user_id,
                u.Nombres           AS username,
                m.Id_Matricula      AS matricula_id,
                m.Fecha_Matricula   AS matricula,
                l.Id_Localidad      AS localidad_id,
                l.Nombre_Localidad  AS localidad,
                b.Id_Barrio         AS barrio_id,
                b.Nombre_Barrio     AS barrio
            FROM usuarios u
            INNER JOIN estudiante  e ON e.Id_usuario = u.Id_usuario
            INNER JOIN matricula   m ON m.Id_estudiante = e.Id_Estudiante
            LEFT JOIN  barrio      b ON b.Id_Barrio = u.Id_Barrio
            LEFT JOIN  localidad   l ON l.Id_Localidad = b.Id_localidad
            SQL);
    }
    
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_matricula_usuario");
    }
};