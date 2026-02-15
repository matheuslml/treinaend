<?php

namespace App\Services;

use App\Models\SupportMaterial;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SupportMaterialCreateService
{
    public function __construct(
        protected SupportMaterialService $supportMaterialService,
    ) {
        //
    }

    public function create(array $request)
    {
        try {
            DB::beginTransaction();

            $pathfile = Storage::disk('material_apoio')->put('material_apoio', $request['link']);

            SupportMaterial::create([
                'discipline_id' => $request['discipline'],
                'title' => $request['title'],
                'link' => $pathfile,
                'icon' => $request['icon'],
                'order' => $request['order']
            ]);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
