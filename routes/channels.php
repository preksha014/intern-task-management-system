
<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;
use Illuminate\Support\Facades\Log;


Broadcast::channel('chat.{senderId}.{recipientId}', function (User $user, $senderId, $recipientId) {
    Log::info("In channel:chat.{$senderId}.{$recipientId}");
    return (int) $user->id === (int) $senderId || (int) $user->id === (int) $recipientId;
    // return true;
});