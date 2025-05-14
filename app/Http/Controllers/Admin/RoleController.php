<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Permission;
class RoleController extends Controller
{
    public function index(): View
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create(): View
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:roles',
                'description' => 'nullable|string|max:1000',
                'permissions' => 'array',
                'permissions.*' => 'exists:permissions,id'
            ]);

            $role = Role::create([
                'name' => $validated['name'],
                'description' => $validated['description']
            ]);

            if ($request->has('permissions')) {
                $role->permissions()->sync($request->permissions);
            }

            return redirect()->route('roles.index')
                ->with('success', 'Role created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the role.');
        }

    }

    public function edit(Role $role): View
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        try{
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
                'description' => 'nullable|string|max:1000',
            ]);
    
            $role->update($validated);
    
            $role->permissions()->sync($request->permissions);
            return redirect()->route('roles.index')
                ->with('success', 'Role updated successfully.');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'An error occurred while updating the role.');
        }  
    }

    public function destroy(Role $role)
    {
        try{
            $role->delete();
            $role->permissions()->detach();
            return redirect()->route('roles.index')
                ->with('success', 'Role deleted successfully.');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'An error occurred while deleting the role.');
        }
    }
}