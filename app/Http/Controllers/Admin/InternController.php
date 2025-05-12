<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Intern;
use App\Models\User;
use App\Models\Task;
use App\Http\Requests\InternRequest;
class InternController extends Controller
{
    public function index()
    {
        $interns = Intern::paginate(5);
        return view('admin.interns.index', compact('interns'));
    }

    public function create()
    {
        return view('admin.interns.create');
    }

    public function store(InternRequest $request)
    {
        $request->validated();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Intern::create([
            'user_id' => $user->id,
            'department' => $request->department,
        ]);

        return redirect()->route('interns.index')->with('success', 'Intern created successfully.');
    }

    public function show(Intern $intern)
    {
        return view('admin.interns.show', compact('intern'));
    }

    public function edit(Intern $intern)
    {
        return view('admin.interns.edit', compact('intern'));
    }

    public function update(InternRequest $request, Intern $intern)
    {
        $request->validated();

        $intern->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $intern->update([
            'department' => $request->department,
        ]);

        return redirect()->route('interns.index')->with('success', 'Intern updated successfully.');
    }

    public function destroy(Intern $intern)
    {
        $user = $intern->user;

        $intern->delete();
        $user->delete();

        return redirect()->route('interns.index')->with('success', 'Intern deleted successfully.');
    }
    public function assign()
    {
        $tasks = Task::whereIn('status', ['pending', 'in_progress'])->get();
        $interns = Intern::all();
        return view('admin.interns.assign', compact('tasks', 'interns'));
    }

    public function assignStore(Request $request)
    {
        $validated = $request->validate([
            'intern_id' => 'required|exists:interns,id',
            'task_id' => 'required|array|min:1',
            'task_id.*' => 'exists:tasks,id',
        ]);

        foreach ($validated['task_id'] as $taskId) {
            $task = Task::find($taskId);
            $task->interns()->attach($validated['intern_id']);
        }

        return redirect()->route('interns.index')->with('success', 'Tasks assigned successfully.');
    }
}
