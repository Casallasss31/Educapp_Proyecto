<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificado', function (Blueprint $table) {
            $table->increments('Id_Certificado');

            $table->integer('Año')->nullable();

            $table->string('Nombre_Certificado', 150)->nullable();

            $table->integer('Id_Tipo_Certificado')->nullable();

            $table->integer('Id_estudiante')->nullable();

            $table->foreign('Id_Tipo_Certificado')
                ->references('Id_Tipo_Certificado')
                ->on('tipo_certificado');

            $table->foreign('Id_estudiante')
                ->references('Id_Estudiante')
                ->on('estudiante');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificado');
    }
};