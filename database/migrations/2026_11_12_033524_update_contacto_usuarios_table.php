<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {

            $table->string('Numero_Telefono', 20)
                ->nullable()
                ->change();

            $table->string('Correo', 150)
                ->nullable()
                ->change();

            $table->unique(
                'Correo',
                'usuarios_correo_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {

            $table->dropUnique(
                'usuarios_correo_unique'
            );

            $table->integer('Numero_Telefono')
                ->nullable()
                ->change();

            $table->string('Correo', 150)
                ->nullable()
                ->change();
        });
    }
};
