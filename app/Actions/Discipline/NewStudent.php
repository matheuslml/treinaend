<?php

namespace App\Actions\Discipline;

use App\Models\Discipline;
use App\Models\DisciplinePeople;
use Carbon\Carbon;
use Exception;
use Lorisleiva\Actions\Concerns\AsAction;
use Smalot\PdfParser\Parser;

class NewStudent
{
    use AsAction;

    /**
     * @throws Exception
     */
    public function handle($person_id): void
    {
        $discipline = Discipline::where('order', 1)->first();
        if((DisciplinePeople::where('person_id', $person_id)->first())==null){
            $today = Carbon::today();
            DisciplinePeople::updateOrCreate(
                [
                    'discipline_id' => $discipline->id,
                    'person_id' => $person_id
                ],
                [
                    'exam_date' => $today->copy()->addDays(2),
                    'started_at' => $today,
                    'exam_nr' => 0
                ]
            );
        }
    }

}
