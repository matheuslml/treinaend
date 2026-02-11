<?php

namespace App\Services;

use App\Models\Registration;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class RegistrationService
{
    private RepositoryInterface $registrationRepository;

    /**
     * RegistrationService constructor.
     * @param RepositoryInterface $registrationRepository
     */
    public function __construct(RepositoryInterface $registrationRepository)
    {
        $this->registrationRepository = $registrationRepository;
    }

    public function get()
    {
        return $this->registrationRepository->get();
    }

    public function create(array $request): Registration
    {
        return $this->registrationRepository->create($request);
    }

    public function show($id): Registration
    {
        return $this->registrationRepository->find($id);
    }

    public function update(array $request, $id): Registration
    {
        return $this->registrationRepository->update($id, $request);
    }

    public function delete($id): Registration
    {
        return $this->registrationRepository->delete($id);
    }

    public function restore($id): Registration
    {
        return $this->registrationRepository->restore($id);
    }

    public function forceDelete($id): Registration
    {
        return $this->registrationRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->registrationRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
