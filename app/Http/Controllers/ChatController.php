<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Admins see all interns and their messages
            $users = User::where('role', 'intern')->get();
          
            $messages = Message::whereIn('sender_id', $users->pluck('id'))
                ->orWhereIn('recipient_id', $users->pluck('id'))
                ->orWhere('sender_id', $user->id)
                ->orWhere('recipient_id', $user->id)
                ->with(['sender', 'recipient'])
                ->get();
        } else {
            // Interns only see the admin and messages to/from the admin
            $admin = User::where('role', 'admin')->first();

            $users = $admin ? collect([$admin]) : collect([]);
            
            $messages = Message::where(function ($query) use ($user, $admin) {
                $query->where('sender_id', $user->id)
                      ->where('recipient_id', $admin->id)
                      ->orWhere('sender_id', $admin->id)
                      ->where('recipient_id', $user->id);
            })->with(['sender', 'recipient'])->get();
        }

        return view('chat', compact('users', 'messages'));
    }
    public function sendMessage(Request $request)
    {
        try {
            $user = Auth::user();
    
            $request->validate([
                'recipient_id' => [
                    'required',
                    'exists:users,id',
                    function ($attribute, $value, $fail) use ($user) {
                        $recipient = User::find($value);
                        if (!$recipient) return;
    
                        if ($user->role === 'intern' && $recipient->role !== 'admin') {
                            $fail('Interns can only send messages to admins.');
                        } elseif ($user->role === 'admin' && $recipient->role !== 'intern') {
                            $fail('Admins can only send messages to interns.');
                        }
                    },
                ],
                'content' => 'required|string|max:1000',
            ]);
    
            $message = Message::create([
                'sender_id' => $user->id,
                'recipient_id' => $request->recipient_id,
                'content' => $request->content,
                'read' => false,
            ]);
    
            $message->load(['sender', 'recipient']);
    
            broadcast(new MessageSent($message))->toOthers();
    
            return response()->json([
                'status' => 'success',
                'message' => 'Message sent successfully',
                'data' => $message
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}