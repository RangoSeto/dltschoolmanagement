<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostLiveViewerEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $count;
    public $postid;
    public function __construct($count,$postid)
    {
        $this->count = $count;
        $this->postid = $postid;
    }

    public function broadcastOn(): array
    {
        return ['postliveviewer-channel_'.$this->postid];
    }

    public function broadcastAs()
    {
        return 'postliveviewer-event';
    }
}


// php artisan make:event PostLiveViewerEvent