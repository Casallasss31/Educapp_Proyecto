<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Interfaces
use App\Interfaces\UsuarioInterface;
use App\Interfaces\DetalleBoletinInterface;
use App\Interfaces\RolInterface;
use App\Interfaces\EPSInterface;
use App\Interfaces\GrupoSanguineoInterface;
use App\Interfaces\LocalidadInterface;
use App\Interfaces\BarrioInterface;
use App\Interfaces\ProfesionInterface;
use App\Interfaces\DocenteInterface;
use App\Interfaces\RectorInterface;
use App\Interfaces\AsistenteAdministrativoInterface;
use App\Interfaces\AcudienteInterface;
use App\Interfaces\EstudianteInterface;
use App\Interfaces\GradoInterface;
use App\Interfaces\CursoInterface;
use App\Interfaces\AreaInterface;
use App\Interfaces\NotaInterface;
use App\Interfaces\MateriaInterface;
use App\Interfaces\BoletinInterface;
use App\Interfaces\TipoCertificadoInterface;
use App\Interfaces\CertificadoInterface;
use App\Interfaces\MatriculaInterface;
use App\Interfaces\HorarioAcademicoInterface;

// Repositories
use App\Repositories\UsuarioRepository;
use App\Repositories\DetalleBoletinRepository;
use App\Repositories\RolRepository;
use App\Repositories\EPSRepository;
use App\Repositories\GrupoSanguineoRepository;
use App\Repositories\LocalidadRepository;
use App\Repositories\BarrioRepository;
use App\Repositories\ProfesionRepository;
use App\Repositories\DocenteRepository;
use App\Repositories\RectorRepository;
use App\Repositories\AsistenteAdministrativoRepository;
use App\Repositories\AcudienteRepository;
use App\Repositories\EstudianteRepository;
use App\Repositories\GradoRepository;
use App\Repositories\CursoRepository;
use App\Repositories\AreaRepository;
use App\Repositories\NotaRepository;
use App\Repositories\MateriaRepository;
use App\Repositories\BoletinRepository;
use App\Repositories\TipoCertificadoRepository;
use App\Repositories\CertificadoRepository;
use App\Repositories\MatriculaRepository;
use App\Repositories\HorarioAcademicoRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UsuarioInterface::class, UsuarioRepository::class);
        $this->app->bind(RolInterface::class, RolRepository::class);
        $this->app->bind(EPSInterface::class, EPSRepository::class);
        $this->app->bind(GrupoSanguineoInterface::class, GrupoSanguineoRepository::class);
        $this->app->bind(LocalidadInterface::class, LocalidadRepository::class);
        $this->app->bind(BarrioInterface::class, BarrioRepository::class);
        $this->app->bind(ProfesionInterface::class, ProfesionRepository::class);
        $this->app->bind(DocenteInterface::class, DocenteRepository::class);
        $this->app->bind(RectorInterface::class, RectorRepository::class);
        $this->app->bind(AsistenteAdministrativoInterface::class, AsistenteAdministrativoRepository::class);
        $this->app->bind(AcudienteInterface::class, AcudienteRepository::class);
        $this->app->bind(EstudianteInterface::class, EstudianteRepository::class);
        $this->app->bind(GradoInterface::class, GradoRepository::class);
        $this->app->bind(CursoInterface::class, CursoRepository::class);
        $this->app->bind(AreaInterface::class, AreaRepository::class);
        $this->app->bind(NotaInterface::class, NotaRepository::class);
        $this->app->bind(MateriaInterface::class, MateriaRepository::class);
        $this->app->bind(BoletinInterface::class, BoletinRepository::class);
        $this->app->bind(TipoCertificadoInterface::class, TipoCertificadoRepository::class);
        $this->app->bind(CertificadoInterface::class, CertificadoRepository::class);
        $this->app->bind(MatriculaInterface::class, MatriculaRepository::class);
        $this->app->bind(HorarioAcademicoInterface::class, HorarioAcademicoRepository::class);
        $this->app->bind(DetalleBoletinInterface::class, DetalleBoletinRepository::class);
    }

    public function boot(): void
    {
        //
    }
}