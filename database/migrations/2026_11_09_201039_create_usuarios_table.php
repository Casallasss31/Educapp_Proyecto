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

            $table->integer('Id_Rol')->nullable();

            $table->integer('Id_EPS')->nullable();

            $table->integer('Id_Grupo_Sanguineo')->nullable();

            $table->integer('Id_Barrio')->nullable();

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