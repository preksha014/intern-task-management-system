<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use App\Models\Intern;
class DashboardController extends Controller
{
    public function index()
    {
        $totalInterns = User::where('role', 'intern')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalTasks = Task::count();
        $totalCompletedTasks = Task::where('status', 'completed')->count();
        $totalPendingTasks = Task::where('status', 'pending')->count();
        $totalInProgressTasks = Task::where('status', 'in_progress')->count();
        return view('admin.dashboard', compact('totalInterns', 'totalAdmins', 'totalTasks', 'totalCompletedTasks', 'totalPendingTasks', 'totalInProgressTasks'));
    }
}
