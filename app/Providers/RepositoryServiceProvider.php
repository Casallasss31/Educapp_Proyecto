<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\AcudienteInterface;
use App\Repositories\AcudienteRepository;
use App\Interfaces\AreaInterface;
use App\Repositories\AreaRepository;
use App\Interfaces\AsistenteAdministrativoInterface;
use App\Repositories\AsistenteAdministrativoRepository;
use App\Interfaces\BarrioInterface;
use App\Repositories\BarrioRepository;
use App\Interfaces\BoletinInterface;
use App\Repositories\BoletinRepository;
use App\Interfaces\CertificadoInterface;
use App\Repositories\CertificadoRepository;
use App\Interfaces\CursoInterface;
use App\Repositories\CursoRepository;
use App\Interfaces\DetalleBoletinInterface;
use App\Repositories\DetalleBoletinRepository;
use App\Interfaces\DocenteInterface;
use App\Repositories\DocenteRepository;
use App\Interfaces\EPSInterface;
use App\Repositories\EPSRepository;
use App\Interfaces\EstudianteInterface;
use App\Repositories\EstudianteRepository;
use App\Interfaces\GradoInterface;
use App\Repositories\GradoRepository;
use App\Interfaces\GrupoSanguineoInterface;
use App\Repositories\GrupoSanguineoRepository;
use App\Interfaces\HorarioAcademicoInterface;
use App\Repositories\HorarioAcademicoRepository;
use App\Interfaces\LocalidadInterface;
use App\Repositories\LocalidadRepository;
use App\Interfaces\MateriaInterface;
use App\Repositories\MateriaRepository;
use App\Interfaces\MatriculaInterface;
use App\Repositories\MatriculaRepository;
use App\Interfaces\NotaInterface;
use App\Repositories\NotaRepository;
use App\Interfaces\ProfesionInterface;
use App\Repositories\ProfesionRepository;
use App\Interfaces\RectorInterface;
use App\Repositories\RectorRepository;
use App\Interfaces\RolInterface;
use App\Repositories\RolRepository;
use App\Interfaces\TipoCertificadoInterface;
use App\Repositories\TipoCertificadoRepository;
use App\Interfaces\UsuarioInterface;
use App\Repositories\UsuarioRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AcudienteInterface::class, AcudienteRepository::class);
        $this->app->bind(AreaInterface::class, AreaRepository::class);
        $this->app->bind(AsistenteAdministrativoInterface::class, AsistenteAdministrativoRepository::class);
        $this->app->bind(BarrioInterface::class, BarrioRepository::class);
        $this->app->bind(BoletinInterface::class, BoletinRepository::class);
        $this->app->bind(CertificadoInterface::class, CertificadoRepository::class);
        $this->app->bind(CursoInterface::class, CursoRepository::class);
        $this->app->bind(DetalleBoletinInterface::class, DetalleBoletinRepository::class);
        $this->app->bind(DocenteInterface::class, DocenteRepository::class);
        $this->app->bind(EPSInterface::class, EPSRepository::class);
        $this->app->bind(EstudianteInterface::class, EstudianteRepository::class);
        $this->app->bind(GradoInterface::class, GradoRepository::class);
        $this->app->bind(GrupoSanguineoInterface::class, GrupoSanguineoRepository::class);
        $this->app->bind(HorarioAcademicoInterface::class, HorarioAcademicoRepository::class);
        $this->app->bind(LocalidadInterface::class, LocalidadRepository::class);
        $this->app->bind(MateriaInterface::class, MateriaRepository::class);
        $this->app->bind(MatriculaInterface::class, MatriculaRepository::class);
        $this->app->bind(NotaInterface::class, NotaRepository::class);
        $this->app->bind(ProfesionInterface::class, ProfesionRepository::class);
        $this->app->bind(RectorInterface::class, RectorRepository::class);
        $this->app->bind(RolInterface::class, RolRepository::class);
        $this->app->bind(TipoCertificadoInterface::class, TipoCertificadoRepository::class);
        $this->app->bind(UsuarioInterface::class, UsuarioRepository::class);
    }

    public function boot(): void
    {
    }
}
