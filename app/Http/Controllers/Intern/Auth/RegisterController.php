<?php

namespace App\Http\Controllers\Intern\Auth;

use App\Http\Controllers\Controller;
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
        try {
            // Validate the request
            $validated=$request->validated();

            // Create the user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'intern',
            ]);

            // Create the corresponding intern record
            Intern::create([
                'user_id' => $user->id,
                'department' => $validated['department'],
            ]);

            return redirect()->route('intern.login.form')->with('success', 'Intern registered successfully.');
        } catch (\Exception $e) {
            return redirect()->route('intern.register.form')->with('error', 'An error occurred during registration.');
        }
    }
}