<?php

namespace App\Actions\Notifications;

use App\Models\Notification;
use App\Models\NotificationUser;
use App\Models\User;
use Exception;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\Auth;

class SendInternalNotification
{
    use AsAction;

    /**
     * Envia notificação de acordo com o tipo
     * @throws Exception
     */
    public function handle(string $type, string $function, int $user_id): void
    {

        $user = User::findOrFail($user_id);
        $title   = '';
        $content = '';

        // pega último registro e disciplina de forma eficiente
        $latestRegistration = $user->person->registrations()
            ->orderByDesc('created_at')
            ->first();

        $latestDiscipline = $user->person->disciplines()
            ->orderByDesc('created_at')
            ->first();

        switch ($type) {
            case 'newregistration':
                $title   = 'Matrícula Realizada com Sucesso';
                $content = "Matrícula realizada no curso: {$latestRegistration?->course->name} com sucesso.";
                break;

            case 'discipline_notification':
                $title   = $function === 'aproved' ? 'Aprovado na Disciplina' : 'Não Aprovado na Disciplina';
                $content = $function === 'aproved'
                    ? "Disciplina: {$latestDiscipline?->name} foi realizada com sucesso."
                    : "Disciplina: {$latestDiscipline?->name} não foi realizada com sucesso.";
                break;

            case 'course_notification':
                $title   = $function === 'aproved' ? 'Aprovado no Curso' : 'Não Aprovado no Curso';
                $content = $function === 'aproved'
                    ? "Curso: {$latestRegistration?->course->name} foi realizado com sucesso."
                    : "Curso: {$latestRegistration?->course->name} não foi realizado com sucesso.";
                break;

            case 'payments':
                $title   = 'Pagamento';
                $content = 'Seu pagamento foi processado.';
                break;
        }

        $notification = Notification::create([
            'type_id' => 3,
            'status_id' => 2,
            'sender_id' => 1,
            'title'   => $title,
            'content' => $content,
        ]);

        NotificationUser::create([
            'notification_id' => $notification->id,
            'user_id'         => $user->id,
        ]);
    }
}
