<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class QANotification extends Notification
{
    private $project;
    private $user;
    private $project_id;

    public function __construct($event)
    {
        $this->project = $event->project;
        $this->user = $event->user;
        $this->project_id = $event->project_id;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'project' => $this->project,
            'user' => $this->user,
            'project_id' => $this->project_id
        ];
    }
}
