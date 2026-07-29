<?php

namespace App\Services;

use App\Models\NotificationTemplate;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class NotificationTemplateService
{
    private RepositoryInterface $notificationTemplateRepository;

    /**
     * NotificationTemplateService constructor.
     * @param RepositoryInterface $notificationTemplateRepository
     */
    public function __construct(RepositoryInterface $notificationTemplateRepository)
    {
        $this->notificationTemplateRepository = $notificationTemplateRepository;
    }

    public function get()
    {
        return $this->notificationTemplateRepository->get();
    }

    public function create(array $request): NotificationTemplate
    {
        return $this->notificationTemplateRepository->create($request);
    }

    public function show($id): NotificationTemplate
    {
        return $this->notificationTemplateRepository->find($id);
    }

    public function update(array $request, $id): NotificationTemplate
    {
        return $this->notificationTemplateRepository->update($id, $request);
    }

    public function delete($id): NotificationTemplate
    {
        return $this->notificationTemplateRepository->delete($id);
    }

    public function restore($id): NotificationTemplate
    {
        return $this->notificationTemplateRepository->restore($id);
    }

    public function forceDelete($id): NotificationTemplate
    {
        return $this->notificationTemplateRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->notificationTemplateRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
