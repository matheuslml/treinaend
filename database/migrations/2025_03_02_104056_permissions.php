<?php

use App\Models\AgreementOrigin;
use App\Models\AgreementSituation;
use App\Models\BiddingSituation;
use App\Models\DocumentType;
use App\Models\FileType;

use App\Models\LegislationAuthor;

use App\Models\NotificationStatus;
use App\Models\NotificationType;
use App\Models\PermissionInformation;
use App\Models\TypeMedia;
use App\Models\TypePost;
use App\Models\TypeRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class Permissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @throws Exception
     */
    public function up(): void
    {

        // TREINAEND
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver Menu do Aluno', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Aulas', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Aulas', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Aulas', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Aulas', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Exercícios', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Exercícios', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Exercícios', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Exercícios', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Lições', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Lições', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Lições', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Lições', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Matrículas', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Matrículas', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Matrículas', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Matrículas', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Materiais de Apoio', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Materiais de Apoio', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Materiais de Apoio', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Materiais de Apoio', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Disciplinas', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Disciplinas', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Disciplinas', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Disciplinas', 'guard_name' => 'web']);

        // Transparência
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Sobre', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Sobre', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Sobre', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Sobre', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Contratações Diretas', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Contratações Diretas', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Contratações Diretas', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Contratações Diretas', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Galeria', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Galeria', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Galeria', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Galeria', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Galeria', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Galeria', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Galeria', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Galeria', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Liderança', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Liderança', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Liderança', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Liderança', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Projetos', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Projetos', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Projetos', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Projetos', 'guard_name' => 'web']);

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
    }
}
