<?php

namespace App\Notifications;

use App\Models\Domain;
use App\Models\DomainCheck;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DomainStatusChanged extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public readonly Domain $domain,
        public readonly DomainCheck $check,
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $isUp = $this->check->status === 'UP';

        return (new MailMessage)
            ->subject(($isUp ? 'UP' : 'DOWN') . ': ' . $this->domain->url)
            ->greeting('Hello, ' . $notifiable->name . '!')
            ->line('Domain status has changed.')
            ->line('**URL:** ' . $this->domain->url)
            ->line('**Status:** ' . $this->check->status)
            ->line('**HTTP Code:** ' . ($this->check->http_code ?? '—'))
            ->line('**Response Time:** ' . ($this->check->response_time_ms ?? '—') . ' ms')
            ->when(!$isUp && $this->check->error_message, fn ($mail) =>
                $mail->line('**Error:** ' . $this->check->error_message)
            )
            ->action('View Domain', route('domains.show', $this->domain))
            ->salutation('Domain Monitor');
    }
}