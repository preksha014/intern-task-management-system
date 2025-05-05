<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Intern;
use App\Models\User;
use App\Models\Task;
class InternController extends Controller
{
    public function index()
    {
        $interns = Intern::paginate(10);
        return view('admin.interns.index', compact('interns'));
    }

    public function create()
    {
        return view('admin.interns.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

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

    public function show($id)
    {
        $intern = Intern::with('user')->findOrFail($id);
        return view('admin.interns.show', compact('intern'));
    }

    public function edit($id)
    {
        $intern = Intern::with('user')->findOrFail($id);
        return view('admin.interns.edit', compact('intern'));
    }

    public function update(Request $request, $id)
    {
        $intern = Intern::with('user')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $intern->user->id,
            'department' => 'required|string|max:255',
        ]);

        $intern->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $intern->update([
            'department' => $request->department,
        ]);

        return redirect()->route('interns.index')->with('success', 'Intern updated successfully.');
    }

    public function destroy($id)
    {
        $intern = Intern::findOrFail($id);
        $user = $intern->user;

        $intern->delete();
        $user->delete();

        return redirect()->route('interns.index')->with('success', 'Intern deleted successfully.');
    }
    public function assign()
    {
        $tasks = Task::where('status', 'pending')->get();
        $interns = Intern::all();
        return view('admin.interns.assign', compact('tasks', 'interns'));
    }

    public function assignStore(Request $request)
    {
        $validated = $request->validate([
            'intern_id' => 'required|exists:interns,id',
            'task_id' => 'required|exists:tasks,id'
        ]);

        $task = Task::find($validated['task_id']);
        $task->interns()->attach($validated['intern_id']);
        $task->update(['status' => 'in_progress']);

        return redirect()->route('interns.index')->with('success', 'Task assigned successfully.');
    }
}
