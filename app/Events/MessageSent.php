<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Models\Message;
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
        Log::info('Broadcasting on channel: chat.' . $this->message['sender_id'] . '.' . $this->message['recipient_id']);
        return new Channel('chat.' . $this->message['sender_id'] . '.' . $this->message['recipient_id']);
    }

    public function broadcastWith()
    {
        Log::info('Broadcasting with message: ' . $this->message);
        return [
            'message' => [
                'id' => $this->message->id,
                'content' => $this->message->content,
                'sender_id' => $this->message->sender_id,
                'recipient_id' => $this->message->recipient_id,
                'created_at' => $this->message->created_at,
                'sender_name' => $this->message->sender->name,
                'sender_initial' => strtoupper(substr($this->message->sender->name, 0, 1)),
            ],
        ];
    }

    public function broadcastAs()
    {
        return 'MessageSent';
    }
}


