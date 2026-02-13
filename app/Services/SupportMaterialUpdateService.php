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

    public function update(array $request, $support_material_id)
    {
        try {
            DB::beginTransaction();

                if (isset($request['link'])) {

                    $pathfile = Storage::disk('material_apoio')->put('material_apoio', $request['link']);
                    $support_material = SupportMaterial::find($support_material_id);
                    $old_path = storage_path() . '/app/public/files/material_apoio/' . str_replace("material_apoio/", "", $support_material->link);

                    SupportMaterial::updateOrCreate(
                        ['id' => $support_material_id],
                        [
                            'discipline_id' => $request['discipline_id'],
                            'title' => $request['title'],
                            'link' => $pathfile,
                            'icon' => $request['icon'],
                            'order' => $request['order']
                        ]
                    );

                    unlink($old_path);
                }else{
                    $this->supportMaterialService->update($request, $support_material_id);
                }
            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
