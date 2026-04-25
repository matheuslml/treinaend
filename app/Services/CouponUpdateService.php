<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CouponUpdateService
{
    // @codingStandardsIgnoreStart
    // TODO: CSFix
    public function __construct(
        protected UserService $userService,
        protected CouponService $couponService,
    ) {
        //
    }

    public function update(array $request, $coupon_id)
    {
        try {
            DB::beginTransaction();

            $this->couponService->update($request, $coupon_id);

            DB::commit();
        } catch (Exception $exception) {
            ////Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
