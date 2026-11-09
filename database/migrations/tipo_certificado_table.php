<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipo_certificado', function (Blueprint $table) {
            $table->increments('Id_Tipo_Certificado');

            $table->string('Nombre_Certificado', 150)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipo_certificado');
    }
};