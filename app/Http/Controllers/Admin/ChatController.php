<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function index()
    {
        try {
            // Fetch all users for the chat
            $users = User::where('role', '!=', 'admin')->get();
            return view('admin.chat.index', compact('users'));
        } catch (\Exception $e) {
            return redirect()->route('admins.chats.index')->with('error', 'Intern not found');
        }
    }

    public function show($userId)
    {
        try {
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
        } catch (\Exception $e) {
            return redirect()->route('admins.chats.index')->with('error', 'Message not found');
        }
    }

    public function sendMessage(Request $request, $userId)
    {
        try {
            // Validate the request
            $request->validate([
                'content' => 'required|string|max:255',
            ]);

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
        } catch (\Exception $e) {
            return redirect()->route('admins.chats.index')->with('error', 'Message not sent');
        }
    }
}