<?php

namespace App\Services;

use App\Models\Certificate;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CertificateUpdateService
{
    public function __construct(
        protected CertificateService $certificateService,
    ) {
        //
    }

    public function update(array $request, $certificate_id)
    {

        try {
            DB::beginTransaction();

            $this->certificateService->update($request, $certificate_id);
            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            dd($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
