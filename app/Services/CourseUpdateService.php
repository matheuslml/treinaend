<?php

namespace App\Services;

use App\Models\Course;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CourseUpdateService
{
    public function __construct(
        protected CourseService $courseService,
    ) {
        //
    }

    public function update(array $request, $course_id)
    {

        try {
            DB::beginTransaction();

                $strings_1 = ['.', 'R$ ', ','];
                $strings_2 = ['', '', '.'];
                $replacements = array(
                    "payment_value" => floatval(str_replace($strings_1, $strings_2, $request['payment_value']))
                );

                $changed = array_replace($request, $replacements);

                $course = Course::find($course_id);
                $old_path = $course->image_certificate;

                $course->name = isset($changed['name']) ? $changed['name']  : '';
                $course->acronym = isset($changed['acronym']) ? $changed['acronym']  : '';
                $course->order = $changed['order'];
                $course->grade = $changed['grade'];
                $course->type = $changed['type'];
                $course->payment_value = isset($changed['payment_value']) ? $changed['payment_value']  : 0;
                $course->observation_certificate = isset($changed['observation_certificate']) ? $changed['observation_certificate']  : '';
                $course->coordinator_certificate = isset($changed['coordinator_certificate']) ? $changed['coordinator_certificate']  : '';
                $course->image_certificate = isset($changed['path']) ? $changed['path']  : $old_path;
                $course->status = $changed['status'];
                $course->save();

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            dd($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
