<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class QA implements ShouldBroadcast {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $array;
    public $project;
    public $user;
    public $project_id;

    public function __construct($array){
        $this->project = $array['project'];
        $this->user = $array['user'];
        $this->project_id = $array['project_id'];
    }

    public function broadcastAs()
    {
        return 'project-status';
    }

    public function broadcastOn(){
        return ['buzzguard'];
    }
}
