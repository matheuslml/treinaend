<?php

namespace App\Services;

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
            $this->courseService->create($request);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
