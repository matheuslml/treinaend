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
    public function handle($person_id, $course_id): void
    {
        $discipline = Discipline::where('course_id', $course_id)->where('order', 1)->first();
        $today = Carbon::today();
        $exam_date = $today->copy()->addDays(2);

        DisciplinePeople::updateOrCreate(
            [
                'discipline_id' => $discipline->id,
                'person_id' => $person_id
            ],
            [
                'exam_date' => $exam_date->toDateString(),
                'started_at' => $today->toDateString(),
                'exam_nr' => 0
            ]
        );
    }

}
