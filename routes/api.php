<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DetalleBoletinController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\EPSController;
use App\Http\Controllers\GrupoSanguineoController;
use App\Http\Controllers\LocalidadController;
use App\Http\Controllers\BarrioController;
use App\Http\Controllers\ProfesionController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\RectorController;
use App\Http\Controllers\AsistenteAdministrativoController;
use App\Http\Controllers\AcudienteController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\BoletinController;
use App\Http\Controllers\TipoCertificadoController;
use App\Http\Controllers\CertificadoController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\HorarioAcademicoController;

Route::prefix('v1')->name('api.v1.')->group(function () {
    // Usuarios y roles
    Route::apiResource('usuarios', UsuarioController::class);
    Route::apiResource('roles', RolController::class);

    // Información general
    Route::apiResource('eps', EPSController::class);
    Route::apiResource('grupos-sanguineos', GrupoSanguineoController::class);
    Route::apiResource('localidades', LocalidadController::class);
    Route::apiResource('barrios', BarrioController::class);
    Route::apiResource('profesiones', ProfesionController::class);

    // Personal institucional
    Route::apiResource('docentes', DocenteController::class);
    Route::apiResource('rectores', RectorController::class);
    Route::apiResource('asistentes-administrativos', AsistenteAdministrativoController::class);

    // Comunidad educativa
    Route::apiResource('acudientes', AcudienteController::class);
    Route::apiResource('estudiantes', EstudianteController::class);

    // Información académica
    Route::apiResource('grados', GradoController::class);
    Route::apiResource('cursos', CursoController::class);
    Route::apiResource('areas', AreaController::class);
    Route::apiResource('notas', NotaController::class);
    Route::apiResource('materias', MateriaController::class);

    // Consultas personalizadas antes de los recursos dinámicos
    Route::get('boletines/estudiante/{idEstudiante}', [BoletinController::class, 'porEstudiante'])
        ->whereNumber('idEstudiante')->name('boletines.por-estudiante');
    Route::apiResource('boletines', BoletinController::class);

    Route::get('detalles-boletin/boletin/{idBoletin}', [DetalleBoletinController::class, 'porBoletin'])
        ->whereNumber('idBoletin')->name('detalles-boletin.por-boletin');
    Route::apiResource('detalles-boletin', DetalleBoletinController::class);

    Route::apiResource('tipos-certificado', TipoCertificadoController::class);

    Route::get('certificados/estudiante/{idEstudiante}', [CertificadoController::class, 'porEstudiante'])
        ->whereNumber('idEstudiante')->name('certificados.por-estudiante');
    Route::apiResource('certificados', CertificadoController::class);

    Route::get('matriculas/estudiante/{idEstudiante}', [MatriculaController::class, 'porEstudiante'])
        ->whereNumber('idEstudiante')->name('matriculas.por-estudiante');
    Route::apiResource('matriculas', MatriculaController::class);

    Route::get('horarios-academicos/curso/{idCurso}', [HorarioAcademicoController::class, 'porCurso'])
        ->whereNumber('idCurso')->name('horarios-academicos.por-curso');
    Route::apiResource('horarios-academicos', HorarioAcademicoController::class);
});
