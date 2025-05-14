<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Intern;
use App\Models\User;
use App\Models\Task;
use App\Http\Requests\InternRequest;
use App\Notifications\TaskAssigned;
use Illuminate\Support\Facades\Auth;
class InternController extends Controller
{
    public function index()
    {
        try {
            $interns = Intern::paginate(5);
            return view('admin.interns.index', compact('interns'));
        } catch (\Exception $e) {
            return redirect()->route('interns.index')->with('error', 'Something went wrong');
        }
    }

    public function create()
    {
        return view('admin.interns.create');
    }

    public function store(InternRequest $request)
    {
        try {
            $request->validated();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'intern',
            ]);

            Intern::create([
                'user_id' => $user->id,
                'department' => $request->department,
            ]);

            return redirect()->route('interns.index')->with('success', 'Intern created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('interns.index')->with('error', 'Something went wrong');
        }
    }

    public function edit(Intern $intern)
    {
        return view('admin.interns.edit', compact('intern'));
    }

    public function update(InternRequest $request, Intern $intern)
    {
        try {
            $validated = $request->validated();

            $intern->user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            $intern->update([
                'department' => $validated['department'],
            ]);

            return redirect()->route('interns.index')->with('success', 'Intern updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('interns.index')->with('error', 'Something went wrong');
        }
    }
    public function destroy(Intern $intern)
    {
        try {
            $user = $intern->user;

            $intern->delete();
            $user->delete();

            return redirect()->route('interns.index')->with('success', 'Intern deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('interns.index')->with('error', 'Something went wrong');
        }

    }
    public function assign()
    {
        try {
            $tasks = Task::whereIn('status', ['pending', 'in_progress'])->get();
            $interns = Intern::all();
            return view('admin.interns.assign', compact('tasks', 'interns'));
        } catch (\Exception $e) {
            return redirect()->route('interns.index')->with('error', 'Something went wrong');
        }
    }

    public function assignStore(Request $request)
    {
        try {
            $validated = $request->validate([
                'intern_id' => 'required|exists:interns,id',
                'task_id' => 'required|array|min:1',
                'task_id.*' => 'exists:tasks,id',
            ]);

            $intern = Intern::find($validated['intern_id']);
            $assignedTasks = [];
            $duplicateTasks = [];

            foreach ($validated['task_id'] as $taskId) {
                $task = Task::find($taskId);

                // Check if task is already assigned to this intern
                if (!$intern->tasks()->where('task_id', $taskId)->exists()) {
                    $task->interns()->attach($validated['intern_id']);
                    $assignedTasks[] = $task;
                } else {
                    $duplicateTasks[] = $task->title;
                }
            }

            if (count($assignedTasks) > 0) {
                $intern->notify(new TaskAssigned($assignedTasks, Auth::user()));
                $message = 'Tasks assigned successfully.';

                if (count($duplicateTasks) > 0) {
                    $message .= ' Some tasks were skipped as they were already assigned: ' . implode(', ', $duplicateTasks);
                }

                return redirect()->route('interns.index')->with('success', $message);
            }

            return redirect()->route('interns.index')->with('error', 'All selected tasks are already assigned to this intern.');
        } catch (\Exception $e) {
            return redirect()->route('interns.index')->with('error', 'Something went wrong');
        }
    }
}