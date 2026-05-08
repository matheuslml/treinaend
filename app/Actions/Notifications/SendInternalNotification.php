<?php

namespace App\Actions\Notifications;

use App\Models\Coupon;
use App\Models\Course;
use App\Models\Discipline;
use App\Models\DisciplinePeople;
use App\Models\Registration;
use Carbon\Carbon;
use Exception;
use Lorisleiva\Actions\Concerns\AsAction;
use Smalot\PdfParser\Parser;

class SendNotification
{
    use AsAction;

    /**
     * salvar matricula
     * @throws Exception
     */
    public function handle($type, $sender_id): void
    {
        //type - new registration
        //type - discipline aproved or not
        //type - course aprouved or not
        //type - payments
    }
}
