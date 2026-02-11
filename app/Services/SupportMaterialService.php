<?php

namespace App\Services;

use App\Models\SupportMaterial;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class SupportMaterialService
{
    private RepositoryInterface $supportMaterialRepository;

    /**
     * SupportMaterialService constructor.
     * @param RepositoryInterface $supportMaterialRepository
     */
    public function __construct(RepositoryInterface $supportMaterialRepository)
    {
        $this->supportMaterialRepository = $supportMaterialRepository;
    }

    public function get()
    {
        return $this->supportMaterialRepository->get();
    }

    public function create(array $request): SupportMaterial
    {
        return $this->supportMaterialRepository->create($request);
    }

    public function show($id): SupportMaterial
    {
        return $this->supportMaterialRepository->find($id);
    }

    public function update(array $request, $id): SupportMaterial
    {
        return $this->supportMaterialRepository->update($id, $request);
    }

    public function delete($id): SupportMaterial
    {
        return $this->supportMaterialRepository->delete($id);
    }

    public function restore($id): SupportMaterial
    {
        return $this->supportMaterialRepository->restore($id);
    }

    public function forceDelete($id): SupportMaterial
    {
        return $this->supportMaterialRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->supportMaterialRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
