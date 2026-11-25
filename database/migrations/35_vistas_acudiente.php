<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Vista 1: Perfil del Acudiente (Uniendo con la tabla usuarios)
        DB::statement("
            CREATE OR REPLACE VIEW vista_acudiente_perfil AS
            SELECT 
                a.id_acudiente AS acudiente_id,
                u.id_usuario AS usuario_id,
                u.nombre AS acudiente_nombre,
                u.apellido AS acudiente_apellido,
                u.correo AS acudiente_correo,
                u.telefono AS acudiente_telefono
            FROM acudiente a
            LEFT JOIN usuarios u ON a.id_usuario = u.id_usuario;
        ");

        // Vista 2: Vínculo Estudiantil (Relación acudiente con estudiantes a cargo)
        DB::statement("
            CREATE OR REPLACE VIEW vista_acudiente_estudiantes AS
            SELECT 
                a.id_acudiente AS acudiente_id,
                e.id_estudiante AS estudiante_id,
                us.nombre AS estudiante_nombre,
                us.apellido AS estudiante_apellido
            FROM acudiente a
            LEFT JOIN estudiante e ON e.id_acudiente = a.id_acudiente
            LEFT JOIN usuarios us ON e.id_usuario = us.id_usuario;
        ");

        // Vista 3: Control de Representantes (Conteo de estudiantes por acudiente)
        DB::statement("
            CREATE OR REPLACE VIEW vista_acudiente_control AS
            SELECT 
                a.id_acudiente AS acudiente_id,
                COUNT(e.id_estudiante) AS total_estudiantes_a_cargo
            FROM acudiente a
            LEFT JOIN estudiante e ON e.id_acudiente = a.id_acudiente
            GROUP BY a.id_acudiente;
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_acudiente_control;");
        DB::statement("DROP VIEW IF EXISTS vista_acudiente_estudiantes;");
        DB::statement("DROP VIEW IF EXISTS vista_acudiente_perfil;");
    }
};