<?php

namespace App\Actions\Discipline;

use App\Models\Coupon;
use App\Models\Course;
use App\Models\Discipline;
use App\Models\DisciplinePeople;
use App\Models\Registration;
use Carbon\Carbon;
use Exception;
use Lorisleiva\Actions\Concerns\AsAction;
use Smalot\PdfParser\Parser;

class NewStudent
{
    use AsAction;

    /**
     * salvar matricula
     * @throws Exception
     */
    public function handle($person_id, $course_id, $coupon): void
    {
        $discipline = Discipline::where('course_id', $course_id)->where('order', 1)->first();
        $course = Course::find($course_id);
        $today = Carbon::today();
        $exam_date = $today->copy()->addDays(2);

        $coupon = Coupon::where('code', $coupon)->first();

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

        Registration::updateOrCreate(
            [
                'course_id' => $course_id,
                'person_id' => $person_id
            ],
            [
                'coupon_id' => $coupon != null ? $coupon->id : null,
                'payment_value' => $course->payment_value,
                'code' => $course->acronym . $today->format('y') . '0' . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT),
                'exam_date' => $exam_date->toDateString(),
                'started_at' => $today->toDateString(),
                'exam_nr' => 0
            ]
        );
    }
}
