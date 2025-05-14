<?php

namespace App\Http\Controllers\Intern\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('interns.auth.login');
    }

    public function login(LoginRequest $request)
    {
        try {
            // Validate the request
            $request->validated();

            // Attempt to log the user in
            if (Auth::guard('intern')->attempt($request->only('email', 'password'))) {
                if (Auth::guard('intern')->user()->role === 'intern') {
                    return redirect()->route('intern.dashboard')->with('success', 'Logged in successfully.');
                }
                Auth::guard('intern')->logout();
                return redirect()->back()->withErrors(['email' => 'You are not an intern.']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['email' => 'An error occurred. Please try again later.']);
        }
    }

    public function logout(Request $request)
    {
        try{
            if (Auth::guard('intern')->check()) {
                Auth::guard('intern')->logout();
            }
            return redirect()->route('intern.login')->with('status', 'Logged out successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['email' => 'An error occurred. Please try again later.']);
        }
    }
}