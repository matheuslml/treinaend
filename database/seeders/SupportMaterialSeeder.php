<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SupportMaterialSeeder extends Seeder
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
        $filePath = database_path('seeders/raw/support_materials.sql');
        if(File::exists($filePath)){
            DB::unprepared(file_get_contents($filePath));
            $this->command->info('Support Material Table Seed');
        }
    }
}