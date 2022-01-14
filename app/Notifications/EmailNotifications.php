<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailNotifications extends Notification implements ShouldQueue
{
    use Queueable;

    private MailMessage $mailMessage;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(MailMessage $mailMessage)
    {
        $this->mailMessage = $mailMessage;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return $this->mailMessage;
    }

}
