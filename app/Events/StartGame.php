<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StartGame
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $variable;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($variable)
    {
        $this->variable = $variable;
        \Log::info($variable);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
      public function broadcastOn() {
        return new Channel('nba-channel');
      }

      public function broadcastWith() {
        return [
          'title' => $this->variable,
        ];
      }
}
