<?php

namespace App\Services;

use App\Models\Course;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CourseCreateService
{
    public function __construct(
        protected CourseService $courseService,
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
                    "payment_value" => floatval(str_replace($strings_1, $strings_2, $request['payment_value']))
                );

                $changed = array_replace($request, $replacements);

                Course::create([
                    'name' => $changed['name'],
                    'description' => $changed['description'],
                    'order' => $changed['order'],
                    'grade' => $changed['grade'],
                    'online' => $changed['online'],
                    'payment_value' => $changed['payment_value'],
                    'image_certificate' => isset($changed['path']) ? $changed['path']  : '',
                    'status' => $changed['status']
                ]);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
