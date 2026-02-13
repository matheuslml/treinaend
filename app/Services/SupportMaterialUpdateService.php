<?php

namespace App\Services;

use App\Models\SupportMaterial;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SupportMaterialUpdateService
{
    public function __construct(
        protected SupportMaterialService $supportMaterialService,
    ) {
        //
    }

    public function update(array $request, $supportMaterial_id)
    {

        try {
            DB::beginTransaction();

                if (isset($request['link'])) {
                    dd($request);
                }else{
                    $this->supportMaterialService->update($request, $supportMaterial_id);
                }
            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            dd($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
