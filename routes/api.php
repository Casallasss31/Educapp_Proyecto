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


Route::prefix('v1')->group(function () {
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
Route::apiResource('boletines', BoletinController::class);
Route::apiResource('detalles-boletin', DetalleBoletinController::class);
Route::apiResource('tipos-certificado', TipoCertificadoController::class);
Route::apiResource('certificados', CertificadoController::class);
Route::apiResource('matriculas', MatriculaController::class);
Route::apiResource('horarios-academicos', HorarioAcademicoController::class);

});