<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Intern;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['creator', 'interns'])->latest()->paginate(10);
        $interns = Intern::with('tasks')->get();
        return view('admin.tasks.index', compact('tasks', 'interns'));
    }

    public function create()
    {
        $interns = Intern::with('tasks')->get();
        return view('admin.tasks.create', compact('interns'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date|after:today',
            'status' => 'required|in:pending,in_progress,completed',
            'interns' => 'required|array|exists:interns,id'
        ]);

        $task = Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'due_date' => $validated['due_date'],
            'status' => $validated['status'],
            'created_by' => Auth::id(),
        ]);

        $task->interns()->attach($validated['interns']);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        $task->load(['creator', 'interns']);
        return view('admin.tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $interns = Intern::all();
        $task->load('interns');
        return view('admin.tasks.edit', compact('task', 'interns'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date|after:today',
            'status' => 'required|in:pending,in_progress,completed',
            'interns' => 'required|array|exists:interns,id'
        ]);

        $task->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'due_date' => $validated['due_date'],
            'status' => $validated['status'],
        ]);

        $task->interns()->sync($validated['interns']);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
