<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CertificateCreateService
{
    public function __construct(
        protected CertificateService $certificateService,
    ) {
        //
    }

    public function create(array $request)
    {
        try {
            DB::beginTransaction();
            $this->certificateService->create($request);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
