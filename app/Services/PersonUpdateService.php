<?php

namespace App\Services;

use App\Models\OccupationUser;
use App\Models\Person;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PersonUpdateService
{
    // TODO: verificar imagem , editar user
    public function __construct(
        protected UserService $userService,
        protected DocumentService $documentService,
        protected EmailService $emailService,
        protected PhoneService $phoneService,
    ) {
        //
    }

    public function update(array $request, $person_id)
    {
        try {
            DB::beginTransaction();

            Person::updateOrCreate(
                [
                    'id' => $person_id
                ],
                [
                    'full_name' => $request['person_name'],
                    'social_name' => $request['social_name']
                ]
            );

            if(isset($request['documents'])){
                foreach ($request['documents']['document_type'] as $key => $documents) {
                    $documentId = $request['documents']['id'][$key];
                    if ($request['documents']['document'][$key]) {
                        $this->documentService->update(
                            [
                            'document_type_id' => $request['documents']['document_type'][$key],
                            'document' => $request['documents']['document'][$key],
                            ], $documentId
                        );
                    }
                }
            }

            DB::commit();
        } catch (Exception $exception) {
            ////Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
