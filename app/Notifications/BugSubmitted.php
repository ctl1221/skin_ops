<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;
use App\Bug;

class BugSubmitted extends Notification implements ShouldQueue
{
    use Queueable;

    private $bug;

    public function __construct(Bug $bug)
    {
        $this->bug = $bug;
    }

    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        $url = url('/bugs/' . $this->bug->id);
        return (new SlackMessage)
            ->error()
            ->to('#it_issues')
            ->content('A bug has been submitted by ' . $this->bug->user->name)
            ->attachment(function ($attachment) use ($url) {
                $attachment->title($this->bug->title, $url)
                    ->content($this->bug->details);
            });
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
