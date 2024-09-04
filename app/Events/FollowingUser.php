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

class FollowingUser implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $follower;
    public $followed;

    public function __construct(User $follower, User $followed)
    {
        $this->follower = $follower;
        $this->followed = $followed;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('users.' . $this->followed->id);
    }

    public function broadcastWith()
    {
        return [
            'message' => "{$this->follower->name} has followed you.",
            'follower_id' => $this->follower->id,
            'follower_name' => $this->follower->name,
        ];
    }
}
