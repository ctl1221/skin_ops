<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class SkinProSlack extends Model
{
    use Notifiable;

    public function routeNotificationForSlack($notification)
    {
        return env('SLACK_WEBHOOK_URL');
    }
}
