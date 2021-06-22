<?php

namespace App\Http\Controllers;
use Pusher\Pusher;

class PusherNotificationController extends Controller{

    public function sendNotification(){
        //Remember to change this with your cluster name.
        $options = array(
            'cluster' => 'eu',
            'encrypted' => true
        );

        //Remember to set your credentials below.
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $message= "Hello Cloudways";

        //Send a message to notify channel with an event name of notify-event
        $pusher->trigger('my-channel', 'my-event', $message);
    }
}
