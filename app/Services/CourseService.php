<?php

namespace App\Services;

use App\Models\Course;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class CourseService
{
    private RepositoryInterface $courseRepository;

    /**
     * CourseService constructor.
     * @param RepositoryInterface $courseRepository
     */
    public function __construct(RepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function get()
    {
        return $this->courseRepository->get();
    }

    public function create(array $request): Course
    {
        return $this->courseRepository->create($request);
    }

    public function show($id): Course
    {
        return $this->courseRepository->find($id);
    }

    public function update(array $request, $id): Course
    {
        return $this->courseRepository->update($id, $request);
    }

    public function delete($id): Course
    {
        return $this->courseRepository->delete($id);
    }

    public function restore($id): Course
    {
        return $this->courseRepository->restore($id);
    }

    public function forceDelete($id): Course
    {
        return $this->courseRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->courseRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
