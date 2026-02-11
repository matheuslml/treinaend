<?php

namespace App\Repositories\Eloquent;

use App\Models\Lesson;
use App\Repositories\EloquentRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\Pure;

class LessonUpdateEloquentRepository extends EloquentRepository
{
    //#[Pure]
    public function __construct()
    {
        parent::__construct(new Lesson());
    }

    public function get(): Collection
    {
        return parent::get();
    }

    public function create(array $data): Lesson | Model
    {
        return parent::create($data);
    }

    public function find($id): Lesson | Model
    {
        return parent::find($id);
    }

    public function withTrashed(): Builder
    {
        return parent::withTrashed();
    }

    public function update($id, array $data): Lesson | Model
    {
        return parent::update($id, $data);
    }

    public function delete($id): Lesson | Model
    {
        return parent::delete($id);
    }

    public function restore($id): Lesson | Model
    {
        return parent::restore($id);
    }

    public function forceDelete($id): Lesson | Model
    {
        return parent::forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return parent::paginate($perPage, $columns, $pageName, $page);
    }
}
