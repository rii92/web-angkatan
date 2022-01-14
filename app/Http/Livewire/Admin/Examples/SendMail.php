<?php

namespace App\Http\Livewire\Admin\Examples;

use App\Notifications\BellNotification;
use App\Notifications\EmailNotifications;
use Illuminate\Notifications\Messages\MailMessage;
use Livewire\Component;

class SendMail extends Component
{

    public function sendMail()
    {
        auth()->user()->notify(new EmailNotifications((new MailMessage)
            ->line('The to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Haloo!'))); 

        auth()->user()->notify(new BellNotification("lorem ipsum dolor, sit amet", route('home')));
    }

    public function render()
    {
        return view('admin.examples.send-mail');
    }
}
