<?php

namespace App\Services;

use App\Models\Discipline;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DisciplineUpdateService
{
    public function __construct(
        protected DisciplineService $disciplineService,
    ) {
        //
    }

    public function update(array $request, $discipline_id)
    {

        try {
            DB::beginTransaction();

            $this->disciplineService->update($request, $discipline_id);
            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            dd($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
