<?php

namespace App\Http\Controllers\Intern;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
class TaskController extends Controller
{
    public function index()
    {
        try {
            // Get authenticated user
            $user = Auth::user();
            // Get intern record for this user
            $intern = $user->intern;
            // Fetch all tasks for this intern with their comments
            $tasks = $intern->tasks()->with(['comments.user'])->get();
            return view('interns.tasks', compact('tasks'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching tasks.');
        }
    }
    public function show(Task $task)
    {
        return view('interns.task-details', compact('task'));
    }
}