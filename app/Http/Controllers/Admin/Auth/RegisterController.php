<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('admin.auth.register');
    }

    public function register(RegisterRequest $request)
    {
        // Validate the request
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

        return redirect()->route('admin.login.form')->with('success', 'Admin registered successfully.');
    }
}