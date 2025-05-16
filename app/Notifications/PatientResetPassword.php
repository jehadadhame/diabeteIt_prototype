<?php

namespace App\Notifications;

use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PatientResetPassword extends Notification
{
    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $resetUrl = url(route('patient.auth.forgot-password.reset-form', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Reset Your Patient Password')
            ->line('You requested a password reset for your patient account.')
            ->action('Reset Password', $resetUrl)
            ->line('If you didn’t request a reset, just ignore this email.');
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
