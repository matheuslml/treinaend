<?php

namespace App\Services;

use App\Models\Discipline;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class DisciplineService
{
    private RepositoryInterface $disciplineRepository;

    /**
     * DisciplineService constructor.
     * @param RepositoryInterface $disciplineRepository
     */
    public function __construct(RepositoryInterface $disciplineRepository)
    {
        $this->disciplineRepository = $disciplineRepository;
    }

    public function get()
    {
        return $this->disciplineRepository->get();
    }

    public function create(array $request): Discipline
    {
        return $this->disciplineRepository->create($request);
    }

    public function show($id): Discipline
    {
        return $this->disciplineRepository->find($id);
    }

    public function update(array $request, $id): Discipline
    {
        return $this->disciplineRepository->update($id, $request);
    }

    public function delete($id): Discipline
    {
        return $this->disciplineRepository->delete($id);
    }

    public function restore($id): Discipline
    {
        return $this->disciplineRepository->restore($id);
    }

    public function forceDelete($id): Discipline
    {
        return $this->disciplineRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->disciplineRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
