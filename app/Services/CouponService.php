<?php

namespace App\Services;

use App\Models\Coupon;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class CouponService
{
    private RepositoryInterface $couponRepository;

    /**
     * CouponService constructor.
     * @param RepositoryInterface $couponRepository
     */
    public function __construct(RepositoryInterface $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    public function get()
    {
        return $this->couponRepository->get();
    }

    public function create(array $request): Coupon
    {
        return $this->couponRepository->create($request);
    }

    public function show($id): Coupon
    {
        return $this->couponRepository->find($id);
    }

    public function update(array $request, $id): Coupon
    {
        return $this->couponRepository->update($id, $request);
    }

    public function delete($id): Coupon
    {
        return $this->couponRepository->delete($id);
    }

    public function restore($id): Coupon
    {
        return $this->couponRepository->restore($id);
    }

    public function forceDelete($id): Coupon
    {
        return $this->couponRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->couponRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
