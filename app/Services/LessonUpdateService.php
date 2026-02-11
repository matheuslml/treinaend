<?php

namespace App\Services;

use App\Models\Lesson;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class LessonUpdateService
{
    public function __construct(
        protected LessonService $lessonService,
    ) {
        //
    }

    public function update(array $request, $lesson_id)
    {

        try {
            DB::beginTransaction();

            $this->lessonService->update($request, $lesson_id);
            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            dd($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
