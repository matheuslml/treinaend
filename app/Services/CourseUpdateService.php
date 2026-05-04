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
                $old_path = $course->image_card;
                $old_path_file = $course->certificate_file;

                $course->name = isset($changed['name']) ? $changed['name']  : '';
                $course->acronym = isset($changed['acronym']) ? $changed['acronym']  : '';
                $course->order = $changed['order'];
                $course->grade = $changed['grade'];
                $course->type = $changed['type'];
                $course->payment_value = isset($changed['payment_value']) ? $changed['payment_value']  : 0;
                $course->certificate_file = isset($changed['path_file']) ? $changed['path_file']  : $old_path_file;
                $course->image_card = isset($changed['path']) ? $changed['path']  : $old_path;
                $course->status = $changed['status'];
                $course->save();

                if(isset($changed['path']) && isset($old_path)){
                    $old_path = storage_path() . '/app/public/images/courses/cards/' . str_replace("cards/", "", $old_path);
                    unlink($old_path);
                }

                if(isset($changed['path_file']) && isset($old_path_file)){
                    $old_path_file = storage_path() . '/app/public/files/courses/certificates/' . str_replace("certificates/", "", $old_path_file);
                    unlink($old_path_file);

                }

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
