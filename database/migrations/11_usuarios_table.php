<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('Id_usuario');

            $table->string('Nombres', 150)->nullable();

            $table->string('Apellidos', 150)->nullable();

            $table->string('Tipo_Documento', 100)->nullable();

            $table->integer('Numero_Documento')->nullable();

            $table->date('Fecha_Nacimiento')->nullable();

            $table->enum('Genero', ['Masculino', 'Femenino'])->nullable();

            // Claves foráneas
            $table->unsignedInteger('Id_Rol')->nullable();

            $table->unsignedInteger('Id_EPS')->nullable();

            $table->unsignedInteger('Id_Grupo_Sanguineo')->nullable();

            $table->unsignedInteger('Id_Barrio')->nullable();

            // Relaciones
            $table->foreign('Id_Rol')
                ->references('Id_Rol')
                ->on('rol');

            $table->foreign('Id_EPS')
                ->references('Id_EPS')
                ->on('eps');

            $table->foreign('Id_Grupo_Sanguineo')
                ->references('Id_GRUPO_SANGUINEO')
                ->on('grupo_sanguineo');

            $table->foreign('Id_Barrio')
                ->references('Id_Barrio')
                ->on('barrio');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};