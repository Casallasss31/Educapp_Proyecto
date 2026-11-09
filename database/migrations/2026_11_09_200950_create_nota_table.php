<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nota', function (Blueprint $table) {
            $table->increments('Id_Nota');

            $table->string('Nombre_Nota', 65)->nullable();

            $table->decimal('nota', 2, 1)->nullable();

            $table->check('nota >= 1.0 AND nota <= 5.0');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nota');
    }
};