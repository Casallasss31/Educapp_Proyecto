
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalle_boletin', function (Blueprint $table) {
            $table->increments('Id_detalle_boletin');

            $table->integer('Fallas')->nullable();

            $table->unsignedInteger('Id_docentes')->nullable();

            $table->unsignedInteger('Id_boletin')->nullable();

            $table->foreign('Id_docentes')
                ->references('Id_Docente')
                ->on('docente');

            $table->foreign('Id_boletin')
                ->references('Id_Boletin')
                ->on('boletin');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_boletin');
    }
};
