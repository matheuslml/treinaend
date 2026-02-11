<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SupportMaterialCreateService
{
    public function __construct(
        protected SupportMaterialService $supportMaterialService,
    ) {
        //
    }

    public function create(array $request)
    {
        try {
            DB::beginTransaction();
            $this->supportMaterialService->create($request);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
