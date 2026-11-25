<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Vista 1: Perfil Integral 360° (Cruzando rol, eps, grupo sanguíneo y barrio)
        DB::statement("
            CREATE OR REPLACE VIEW vista_usuarios_integral AS
            SELECT 
                u.id_usuario AS usuario_id,
                u.nombre AS usuario_nombre,
                u.apellido AS usuario_apellido,
                u.correo AS usuario_correo,
                r.nombre_rol AS rol_nombre,
                e.nombre_eps AS eps_nombre,
                gs.tipo_sangre AS grupo_sanguineo,
                b.nombre_barrio AS barrio_nombre
            FROM usuarios u
            LEFT JOIN rol r ON u.id_rol = r.id_rol
            LEFT JOIN eps e ON u.id_eps = e.id_eps
            LEFT JOIN grupo_sanguineo gs ON u.id_grupo_sanguineo = gs.id_grupo_sanguineo
            LEFT JOIN barrio b ON u.id_barrio = b.id_barrio;
        ");

        // Vista 2: Directorio Activo y de Contacto
        DB::statement("
            CREATE OR REPLACE VIEW vista_usuarios_directorio AS
            SELECT 
                id_usuario AS usuario_id,
                nombre AS usuario_nombre,
                apellido AS usuario_apellido,
                correo AS usuario_correo,
                telefono AS usuario_telefono,
                direccion AS usuario_direccion
            FROM usuarios;
        ");

        // Vista 3: Estadística Demográfica Básica
        DB::statement("
            CREATE OR REPLACE VIEW vista_usuarios_estadistica AS
            SELECT 
                u.id_rol AS rol_id,
                r.nombre_rol AS rol_nombre,
                COUNT(u.id_usuario) AS total_usuarios
            FROM usuarios u
            LEFT JOIN rol r ON u.id_rol = r.id_rol
            GROUP BY u.id_rol, r.nombre_rol;
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_usuarios_estadistica;");
        DB::statement("DROP VIEW IF EXISTS vista_usuarios_directorio;");
        DB::statement("DROP VIEW IF EXISTS vista_usuarios_integral;");
    }
};