<?php

namespace App\Http\Controllers\Intern;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $intern = auth()->user()->intern;
        $tasks = auth()->user()->tasks;
        return view('interns.home', compact('intern', 'tasks'));
    }
}
