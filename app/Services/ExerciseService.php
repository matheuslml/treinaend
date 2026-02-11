<?php

namespace App\Services;

use App\Models\Exercise;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class ExerciseService
{
    private RepositoryInterface $exerciseRepository;

    /**
     * ExerciseService constructor.
     * @param RepositoryInterface $exerciseRepository
     */
    public function __construct(RepositoryInterface $exerciseRepository)
    {
        $this->exerciseRepository = $exerciseRepository;
    }

    public function get()
    {
        return $this->exerciseRepository->get();
    }

    public function create(array $request): Exercise
    {
        return $this->exerciseRepository->create($request);
    }

    public function show($id): Exercise
    {
        return $this->exerciseRepository->find($id);
    }

    public function update(array $request, $id): Exercise
    {
        return $this->exerciseRepository->update($id, $request);
    }

    public function delete($id): Exercise
    {
        return $this->exerciseRepository->delete($id);
    }

    public function restore($id): Exercise
    {
        return $this->exerciseRepository->restore($id);
    }

    public function forceDelete($id): Exercise
    {
        return $this->exerciseRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->exerciseRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
