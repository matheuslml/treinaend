<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RegistrationCreateService
{
    public function __construct(
        protected RegistrationService $registrationService,
    ) {
        //
    }

    public function create(array $request)
    {
        try {
            DB::beginTransaction();

            $strings_1 = ['.', 'R$ ', ','];
            $strings_2 = ['', '', '.'];
            $replacements = array(
                "payment_value" => floatval(str_replace($strings_1, $strings_2, $request['payment_value'])),
                "code" => "IEQ" . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT)
            );

            $changed = array_replace($request, $replacements);

            foreach($changed['users'] as $user){
                $registration = array_merge(
                $changed,
                [
                    'person_id'  => $user
                ]
                );

                $this->registrationService->create($registration);
            }

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
