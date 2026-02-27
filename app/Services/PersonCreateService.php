<?php

namespace App\Services;

use App\Actions\Discipline\MakeRegistration;
use App\Models\AddressPerson;
use App\Models\DepartamentPerson;
use App\Models\OccupationUser;
use App\Models\Person;
use App\Models\PersonAddress;
use App\Models\User;
//use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;

class PersonCreateService
{
    // @codingStandardsIgnoreStart
    // TODO: CSFix
    public function __construct(
        protected UserService $userService,
        protected EmailService $emailService,
        protected PhoneService $phoneService,
    ) {
        //
    }
    // @codingStandardsIgnoreEnd

    public function create(array $request)
    {
        try {
            DB::beginTransaction();

                $person = Person::create([
                    'full_name' => $request['name'],
                    'social_name' => isset($request['social_name']) ? $request['social_name'] : ''
                ]);

                $user = User::create([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'person_id' => $person->id,
                    'password' => Hash::make($request['password'])
                ]);

                $make_registration = resolve(MakeRegistration::class);
                $make_registration->handle($person->id, $request['type']);

                event(new Registered($user));

                foreach ($request['documents']['document_type'] as $key => $documents) {
                    if ($request['documents']['document'][$key]) {
                        $person->documents()->create(
                            [
                            'document_type_id' => $request['documents']['document_type'][$key],
                            'document' => $request['documents']['document'][$key],
                            ]
                        );
                    }
                }
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            dd($exception);
            throw new Exception($exception);
        }
    }
}
