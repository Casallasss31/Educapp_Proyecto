<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grupo_sanguineo', function (Blueprint $table) {
            $table->increments('Id_GRUPO_SANGUINEO');

            $table->enum('Grupo', ['O', 'A', 'B', 'AB'])->nullable();

            $table->enum('RH', ['POSITIVO', 'NEGATIVO'])->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grupo_sanguineo');
    }
};