<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;

class BugSubmitted extends Notification implements ShouldQueue
{
    use Queueable;

    private $bug;

    public function __construct($bug)
    {
        $this->bug = $bug;
    }

    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->to('#it_issues')
            ->content('Test Issue' . $this->bug->title);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
