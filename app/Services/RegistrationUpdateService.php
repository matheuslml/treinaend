<?php

namespace App\Services;

use App\Models\Registration;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RegistrationUpdateService
{
    public function __construct(
        protected RegistrationService $registrationService,
    ) {
        //
    }

    public function update(array $request, $registration_id)
    {

        try {
            DB::beginTransaction();

            $this->registrationService->update($request, $registration_id);
            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            dd($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
