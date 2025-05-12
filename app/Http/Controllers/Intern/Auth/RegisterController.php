<?php

namespace App\Http\Controllers\Intern\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Intern;
use App\Http\Requests\Auth\RegisterRequest;
class RegisterController extends Controller
{
    //
    public function showRegistrationForm()
    {
        return view('interns.auth.register');
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
            'role' => 'intern',
        ]);

        // Create the corresponding intern record
        Intern::create([
            'user_id' => $user->id,
            'department' => $request->department,
        ]);

        return redirect()->route('intern.login.form')->with('success', 'Intern registered successfully.');
    }
}
