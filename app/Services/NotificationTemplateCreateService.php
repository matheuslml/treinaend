<?php

namespace App\Services;

use App\Models\NotificationUser;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NotificationTemplateCreateService
{
    // @codingStandardsIgnoreStart
    // TODO: CSFix
    public function __construct(
        protected NotificationTemplateService $notificationTemplateService
    ) {
        //
    }
    // @codingStandardsIgnoreEnd

    public function create(array $request)
    {
        try {
            DB::beginTransaction();
            //fazer

            DB::commit();
        } catch (Exception $exception) {
            ////Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
