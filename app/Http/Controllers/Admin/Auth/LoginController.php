<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            if (Auth::guard('admin')->user()->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Logged in successfully.');
            }
            Auth::guard('admin')->logout();
            return redirect()->back()->withErrors(['email' => 'You are not an admin.']);
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }
        return redirect()->route('admin.login')->with('status', 'Logged out successfully.');
    }
}
