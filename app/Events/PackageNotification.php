<?php

namespace App\Events;

use App\Package;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PackageNotification implements ShouldBroadcast, ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $package;
    protected $message;
    protected $user;

    /**
     * Create a new event instance.
     *
     * @param $package
     */
    public function __construct($package, $message)
    {
        $this->package = $package->id;
        $this->message = $message;
        $this->user = $package->object_owner;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('App.User.'.$this->user);
    }


    public function broadcastWith()
    {
        return [
            'user' => $this->user,
            'package' => $this->package,
            'message' => $this->message,
            ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'package' => $this->package,
            'message' => $this->message,
            'user' => $this->user,
        ];
    }
}
