<?php

namespace App\Actions\Notifications;

use App\Models\Notification;
use App\Models\NotificationUser;
use App\Models\User;
use Exception;
use Lorisleiva\Actions\Concerns\AsAction;

class SendInternalNotification
{
    use AsAction;

    public function handle(string $type, string $function, int $user_id)
    {
        $user = User::findOrFail($user_id);
        $title   = '';
        $content = '';

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
            'type_id'   => 3,
            'status_id' => 2,
            'sender_id' => 1,
            'title'     => $title,
            'content'   => $content,
        ]);

        NotificationUser::create([
            'notification_id' => $notification->id,
            'user_id'         => $user->id,
        ]);

        // Retorna a URL do WhatsApp apenas em course_notification aprovado
        if ($type === 'course_notification' && $function === 'aproved') {
            return $this->sendWhatsAppMessage("{$title}\n{$content}");
        }

        return null;
    }

    /**
     * Gera e retorna a URL do WhatsApp
     */
    protected function sendWhatsAppMessage(string $message): string
    {
        $phoneNumber = '5522997377972';
        $encodedMessage = urlencode($message);

        return "https://wa.me/{$phoneNumber}?text={$encodedMessage}";
    }
}
