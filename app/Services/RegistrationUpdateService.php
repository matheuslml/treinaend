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
            $strings_1 = ['.', 'R$ ', ','];
            $strings_2 = ['', '', '.'];
            $replacements = array(
                "payment_value" => floatval(str_replace($strings_1, $strings_2, $request['payment_value']))
            );

            $changed = array_replace($request, $replacements);

            $this->registrationService->update($changed, $registration_id);
            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
