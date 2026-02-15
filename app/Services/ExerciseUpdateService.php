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

                if (isset($request['file'])) {

                    $pathfile = Storage::disk('exercise')->put('exercise', $request['file']);
                    $exercise = Exercise::find($exercise_id);
                    $old_path = storage_path() . '/app/public/files/exercise/' . str_replace("exercise/", "", $exercise->file);

                    Exercise::updateOrCreate(
                        ['id' => $exercise_id],
                        [
                            'discipline_id' => $request['discipline_id'],
                            'answers' => $request['answers'],
                            'file' => $pathfile,
                            'correct_answer' => $request['correct_answer'],
                            'type' => $request['type']
                        ]
                    );

                    unlink($old_path);
                }else{
                    $this->exerciseService->update($request, $exercise_id);
                }
            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
