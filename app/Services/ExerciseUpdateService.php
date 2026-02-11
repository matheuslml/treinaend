<?php

namespace App\Services;

use App\Models\Exercise;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ExerciseUpdateService
{
    public function __construct(
        protected ExerciseService $exerciseService,
    ) {
        //
    }

    public function update(array $request, $exercise_id)
    {

        try {
            DB::beginTransaction();

            $this->exerciseService->update($request, $exercise_id);
            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            dd($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
