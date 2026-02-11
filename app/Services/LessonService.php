<?php

namespace App\Services;

use App\Models\Lesson;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class LessonService
{
    private RepositoryInterface $lessonRepository;

    /**
     * LessonService constructor.
     * @param RepositoryInterface $lessonRepository
     */
    public function __construct(RepositoryInterface $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
    }

    public function get()
    {
        return $this->lessonRepository->get();
    }

    public function create(array $request): Lesson
    {
        return $this->lessonRepository->create($request);
    }

    public function show($id): Lesson
    {
        return $this->lessonRepository->find($id);
    }

    public function update(array $request, $id): Lesson
    {
        return $this->lessonRepository->update($id, $request);
    }

    public function delete($id): Lesson
    {
        return $this->lessonRepository->delete($id);
    }

    public function restore($id): Lesson
    {
        return $this->lessonRepository->restore($id);
    }

    public function forceDelete($id): Lesson
    {
        return $this->lessonRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->lessonRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
