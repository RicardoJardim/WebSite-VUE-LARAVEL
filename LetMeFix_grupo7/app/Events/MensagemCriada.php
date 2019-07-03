<?php

namespace App\Events;

use App\Mensagem;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MensagemCriada
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $mensagem;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Mensagem $mensagem)
    {
        $this->mensagem = $mensagem;
    }

    public function broadcastWith()
    {
        $this->mensagem->load(['user']);

        return [
            'mensagem' => array_merge($this->mensagem->toArray(), [
                'selfMessage' => false
            ])
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('chat');
    }
}
