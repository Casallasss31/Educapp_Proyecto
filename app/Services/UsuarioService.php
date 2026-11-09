<?php

namespace App\Services;

use App\Interfaces\UsuarioInterface;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Collection;

class UsuarioService
{
    protected UsuarioInterface $usuarioRepository;

    public function __construct(UsuarioInterface $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    public function getAll(): Collection
    {
        return $this->usuarioRepository->getAll();
    }

    public function findById(int $id): ?Usuario
    {
        return $this->usuarioRepository->findById($id);
    }

    public function create(array $data): Usuario
    {
        return $this->usuarioRepository->create($data);
    }

    public function update(int $id, array $data): ?Usuario
    {
        return $this->usuarioRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->usuarioRepository->delete($id);
    }
}