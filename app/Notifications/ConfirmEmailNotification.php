<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConfirmEmailNotification extends MailNotification
{
    public function __construct(
        public string $token
    ) {
    }

    public function toMail(User $notifiable): MailMessage
    {
        $appName = ['appName' => setting('app-name')];

        return $this->newMailMessage()
            ->subject(trans('auth.email_confirm_subject', $appName))
            ->greeting(trans('auth.email_confirm_greeting', $appName))
            ->line(trans('auth.email_confirm_text'))
            ->action(trans('auth.email_confirm_action'), url('/register/confirm/' . $this->token));
    }
}
