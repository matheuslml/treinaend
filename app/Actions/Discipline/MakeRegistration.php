<?php

namespace App\Actions\Discipline;

use App\Models\Discipline;
use App\Models\DisciplinePeople;
use App\Models\Registration;
use Carbon\Carbon;
use Exception;
use Lorisleiva\Actions\Concerns\AsAction;
use Smalot\PdfParser\Parser;

class MakeRegistration
{
    use AsAction;

    /**
     * @throws Exception
     */
    public function handle($person_id, $type): void
    {
        if($type == 'aluno'){
            Registration::create([
                    'person_id' => $person_id,
                    'payment_value' => floatval(200),
                    'code' => "IEQ" . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT)
                ]);
        }
    }

}
