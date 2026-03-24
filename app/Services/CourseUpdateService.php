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

            $this->courseService->update($request, $course_id);
            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            dd($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
