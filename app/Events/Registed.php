<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class Registed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    /**
     * Tạo một instance mới cho sự kiện.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Các channel mà sự kiện sẽ được phát lên.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('notifications'); // Định nghĩa channel sẽ broadcast
    }

    /**
     * Tên sự kiện khi phát broadcast.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'user.registered';
    }
}


// composer require pusher/pusher-php-server

// npm install --save laravel-echo pusher-js
