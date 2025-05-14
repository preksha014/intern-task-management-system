<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Task $task)
    {
        try {
            $validated = $request->validate([
                'content' => 'required|string|max:1000',
            ]);
            $user = Auth::guard('admin')->user();

            Comment::create([
                'task_id' => $task->id,
                'user_id' => $user->id,
                'content' => $validated['content'],
            ]);

            return redirect()->back()->with('success', 'Comment added successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while adding the comment.');
        }

    }

    public function destroy(Comment $comment)
    {
        try {
            $user = Auth::guard('admin')->user();
            // Only allow comment creator or admin to delete the comment
            if ($user->id === $comment->user_id || $user->admin) {
                $comment->delete();
                return redirect()->back()->with('success', 'Comment deleted successfully.');
            }

            return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the comment.');
        }
    }
}