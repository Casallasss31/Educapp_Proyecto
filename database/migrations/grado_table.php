<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grado', function (Blueprint $table) {
            $table->increments('Id_Grado');

            $table->string('Nombre_Grado', 150)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grado');
    }
};