<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Notifi implements ShouldBroadcast{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(){
        $this->message = "Nowy wpis w projekcie";
    }

    public function broadcastAs()
    {
        return 'project-status';
    }

    public function broadcastOn(){
        return ['buzzguard'];
    }
}
