<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Log;
class ChatController extends Controller
{
    public function index()
    {
        // Fetch all users for the chat
        $users = User::where('role', '!=', 'admin')->get();

        return view('admin.chat.index', compact('users'));
    }

    public function show($userId)
    {
        // Fetch messages between the authenticated user and the specified user
        $authId = auth()->id();

        $recipientId = $userId;
        $messages = Message::where(function ($query) use ($authId, $userId) {
            $query->where(function ($q) use ($authId, $userId) {
                $q->where('sender_id', $authId)
                    ->where('recipient_id', $userId);
            })->orWhere(function ($q) use ($authId, $userId) {
                $q->where('sender_id', $userId)
                    ->where('recipient_id', $authId);
            });
        })->with(['sender', 'recipient'])->orderBy('created_at', 'asc')->get();

        // Get the receiver user information
        $receiver = User::findOrFail($userId);

        return view('admin.chat.show', compact('messages', 'receiver', 'recipientId'));
    }

    public function sendMessage(Request $request, $userId)
    {
        Log::info('In sendMessage');
        // Validate the request
        $request->validate([
            'content' => 'required|string|max:255',
        ]);
        //dd($request);
        // Log::info($userId);
        // Log::info(auth()->user()->id);

        // Create a new message
        $message = Message::create([
            'sender_id' => auth('admin')->user()->id,  // Remove the parentheses
            'recipient_id' => $userId,
            'content' => $request->input('content'),
            'read' => false,
        ]);

        // Broadcast the message
        broadcast(new MessageSent($message));

        // Return a JSON response
        return response()->json([
            'status' => 'success',
            'message' => 'Message sent successfully.',
            'data' => $message,
        ]);
    }

    public function markAsRead($messageId)
    {
        // Mark the message as read
        $message = Message::findOrFail($messageId);
        $message->update(['read' => true]);

        return response()->json(['success' => true]);
    }
}
