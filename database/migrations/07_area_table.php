<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('area', function (Blueprint $table) {
            $table->increments('Id_Area');

            $table->string('Nombre_Area', 150)->nullable();

            $table->string('Descripcion_Area', 500)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('area');
    }
};