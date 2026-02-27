<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *todo
     *terminar seeder, encontrar os que faltam - parei em ANTONIO MARCOS CABICEIRA
     *fazer seeder de user
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $filePath = database_path('seeders/raw/users.sql');
        if(File::exists($filePath)){
            DB::unprepared(file_get_contents($filePath));
            $this->command->info('User Table Seed');
        }

        $user = User::find(1);
        $user->person_id = 1471;
        $user->save();

        $role = Role::where('name', 'Aluno')->first();

        if ($role) {
            // atribui a role para todos os usuários
            User::all()->each(function ($user) use ($role) {
                if($user->id > 1) $user->assignRole([$role]);
            });
        }

        $password = Hash::make('@aluno123');
        User::all()->each(function ($user) use ($password) {
            if($user->id > 1){
                $user->password = $password;
                $user->save();
            }
        });
    }
}
