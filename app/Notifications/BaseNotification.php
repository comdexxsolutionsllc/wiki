<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BaseNotification extends Notification
{

    use Queueable;

    protected $from = 'opus';

    public function via($notifiable)
    {
        return ['slack'];
    }
}
