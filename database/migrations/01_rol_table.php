<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rol', function (Blueprint $table) {
    $table->increments('Id_Rol');

    $table->enum('Tipo', [
        'RECTOR',
        ' ASISTENTE ADMINISTRATIVO',
        'ESTUDIANTE',
        'ACUDIENTE',
        'DOCENTE'
    ])->nullable();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('rol');
    }
};