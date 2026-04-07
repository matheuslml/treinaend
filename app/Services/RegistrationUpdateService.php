<?php

namespace App\Services;

use App\Models\DisciplinePeople;
use App\Models\Registration;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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
            $today = Carbon::today();
            $strings_1 = ['.', 'R$ ', ','];
            $strings_2 = ['', '', '.'];
            $replacements = array(
                "payment_value" => floatval(str_replace($strings_1, $strings_2, $request['payment_value']))
            );

            $changed = array_replace($request, $replacements);
            //verificar se tem que abrir nova matéria

            $disciplines_person = DisciplinePeople::where('person_id', $changed['person_id'])->get();

            if((count($disciplines_person) == 1) && ($disciplines_person->first()->finished_at != null) && ($changed['qualification'] == "S")){
                DisciplinePeople::updateOrCreate(
                    [
                        'discipline_id' => $disciplines_person->first()->discipline->order + 1,
                        'person_id' => $changed['person_id']
                    ],
                    [
                        'exam_date' => $today->copy()->addDays($disciplines_person->first()->discipline->days),
                        'started_at' => $today,
                        'exam_nr' => 0
                    ]
                );
            }
            
            $this->registrationService->update($changed, $registration_id);
            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
