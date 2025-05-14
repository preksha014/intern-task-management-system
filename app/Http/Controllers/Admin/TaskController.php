<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Intern;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['creator', 'interns'])->latest()->paginate(5);
        $interns = Intern::with('tasks')->get();
        return view('admin.tasks.index', compact('tasks', 'interns'));
    }

    public function create()
    {
        $interns = Intern::with('tasks')->get();
        return view('admin.tasks.create', compact('interns'));
    }

    public function store(TaskRequest $request)
    {
        try {
            $validated = $request->validated();

            $validated['created_by'] = Auth::id();

            $task = Task::create($validated);
            $task->interns()->attach($validated['interns']);

            return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('tasks.index')->with('error', 'Task not created successfully.');
        }
    }

    public function show(Task $task)
    {
        $task->load(['creator', 'interns']);
        $roles = Auth::user()->roles;
        return view('admin.tasks.show', compact('task', 'roles'));
    }

    public function edit(Task $task)
    {
        $interns = Intern::all();
        $task->load('interns');
        return view('admin.tasks.edit', compact('task', 'interns'));
    }

    public function update(TaskRequest $request, Task $task)
    {
        try{
            $validated = $request->validated();

            $task->update($validated);
    
            $task->interns()->sync($validated['interns']);
    
            return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
        }catch(\Exception $e){
            return redirect()->route('tasks.index')->with('error', 'Task not updated successfully.');
        }
    }

    public function destroy(Task $task)
    {
        try{
            $task->delete();
            return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
        }catch(\Exception $e){
            return redirect()->route('tasks.index')->with('error', 'Task not deleted successfully.');
        }
    }
}
