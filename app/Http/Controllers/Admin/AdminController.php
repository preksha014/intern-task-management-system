<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminRequest;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::paginate(5);
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.admins.create', compact('roles'));
    }

    public function store(AdminRequest $request)
    {
        $request->validated();

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        // Create the corresponding admin record
        Admin::create([
            'user_id' => $user->id,
            'department' => $request->department,
            'position' => $request->position,
        ]);

        // Sync roles to the user (not admin) to populate the role_user table
        if ($request->has('roles')) {
            $user->roles()->sync($request->input('roles'));
        }

        return redirect()->route('admins.index')->with('success', 'Admin created successfully');
    }

    public function edit(Admin $admin)
    {
        $roles = Role::all();
        if ($admin->user->isSuperAdmin()) {
            return redirect()->route('admins.index')->with('error', 'You cannot edit this admin');
        }
        return view('admin.admins.edit', compact('admin', 'roles'));
    }

    public function update(AdminRequest $request, Admin $admin)
    {
        $user = User::findOrFail($admin->user_id);

        $request->validated();

        // Update the user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        // Update the admin record
        $admin->update([
            'department' => $request->department,
            'position' => $request->position,
        ]);

        // Sync roles to the user
        $user->roles()->sync($request->input('roles'));

        return redirect()->route('admins.index')->with('success', 'Admin updated successfully');
    }

    public function destroy(Admin $admin)
    {
        if ($admin->user->isSuperAdmin()) {
            return redirect()->route('admins.index')->with('error', 'You cannot delete this admin');
        }
        $user = User::findOrFail($admin->user_id);

        // Detach roles from the user
        $user->roles()->detach();

        // Delete the admin and user records
        $admin->delete();
        $user->delete();

        return redirect()->route('admins.index')->with('success', 'Admin deleted successfully');
    }
}