<?php

namespace App\Services;

use App\Models\Exercise;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ExerciseCreateService
{
    public function __construct(
        protected ExerciseService $exerciseService,
    ) {
        //
    }

    public function create(array $request)
    {
        try {
            DB::beginTransaction();

            $pathfile = Storage::disk('exercise')->put('exercise', $request['file']);

            Exercise::create([
                'discipline_id' => $request['discipline_id'],
                'file' => $pathfile,
                'answers' => $request['answers'],
                'correct_answer' => $request['correct_answer'],
                'type' => $request['type']
            ]);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
