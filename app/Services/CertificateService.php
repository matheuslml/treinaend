<?php

namespace App\Services;

use App\Models\Certificate;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class CertificateService
{
    private RepositoryInterface $certificateRepository;

    /**
     * CertificateService constructor.
     * @param RepositoryInterface $certificateRepository
     */
    public function __construct(RepositoryInterface $certificateRepository)
    {
        $this->certificateRepository = $certificateRepository;
    }

    public function get()
    {
        return $this->certificateRepository->get();
    }

    public function create(array $request): Certificate
    {
        return $this->certificateRepository->create($request);
    }

    public function show($id): Certificate
    {
        return $this->certificateRepository->find($id);
    }

    public function update(array $request, $id): Certificate
    {
        return $this->certificateRepository->update($id, $request);
    }

    public function delete($id): Certificate
    {
        return $this->certificateRepository->delete($id);
    }

    public function restore($id): Certificate
    {
        return $this->certificateRepository->restore($id);
    }

    public function forceDelete($id): Certificate
    {
        return $this->certificateRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->certificateRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
