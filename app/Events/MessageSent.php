<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $message;

    public function __construct($message)
    {
        Log::info($message);
        $this->message = $message;
    }

    public function broadcastOn()
    {
        //Log::info('Broadcasting on channel: chat.' . $this->message['sender_id'].'.' . $this->message['recipient_id']);
        return new Channel('chat.' . $this->message['sender_id'].'.' . $this->message['recipient_id']);
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message,
        ];
    }

    public function broadcastAs()
    {
        return 'MessageSent';
    }
}


