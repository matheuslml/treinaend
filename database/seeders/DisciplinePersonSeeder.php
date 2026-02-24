<?php

namespace Database\Seeders;

use App\Models\DisciplinePeople;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DisciplinePersonSeeder extends Seeder
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
        $filePath = database_path('seeders/raw/discipline_person.sql');
        if(File::exists($filePath)){
            DB::unprepared(file_get_contents($filePath));
            $this->command->info('Discipline People Table Seed');
        }

        // Atualiza todos os registros com score == NULL para 0
        DisciplinePeople::whereNull('score')->update(['score' => 0]);
        $this->command->info('Discipline People scores atualizados para 0 onde estavam NULL');

        DisciplinePeople::whereNull('exam_nr')->update(['exam_nr' => 0]);
        $this->command->info('Discipline People NR atualizados para 0 onde estavam NULL');

    }
}
