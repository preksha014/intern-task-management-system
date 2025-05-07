<?php

namespace App\Http\Controllers\Intern;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Intern;
use Illuminate\Support\Facades\Auth;
class TaskController extends Controller
{
    public function index()
    {
        // Get authenticated user
        $user = Auth::user();
        // Get intern record for this user
        $intern = $user->intern;
        // Fetch all tasks for this intern with their comments
        $tasks = $intern->tasks()->with(['comments.user'])->get();
        return view('interns.tasks', compact('tasks'));
    }
}