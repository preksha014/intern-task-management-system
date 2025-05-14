<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intern;
class NotificationController extends Controller
{
    /**
     * Mark a notification as read
     */
    public function index(){
        $intern = Intern::where('user_id', auth()->id())->first();
        // $user = auth()->guard('intern')->user();
        // dd($intern);
        $notifications = $intern->notifications;
        // dd($notifications);
        return view("interns.notifications",compact('notifications'));
    }
    public function markAsRead(Request $request, $id)
    {
        $intern = Intern::where('user_id', auth()->id())->first();
        $notification = $intern->notifications()->findOrFail($id);
        $notification->markAsRead();
        
        return back()->with('success', 'Notification marked as read.');
    }
    
    /**
     * Mark all notifications as read
     */
    public function markAllAsRead(Request $request)
    {
        $intern = Intern::where('user_id', auth()->id())->first();
        $intern->unreadNotifications->markAsRead();
        
        return back()->with('success', 'All notifications marked as read.');
    }

    public function destroy($id)
    {
        $intern = Intern::where('user_id', auth()->id())->first();
        $notification = $intern->notifications()->findOrFail($id);
        $notification->delete();
        return back()->with('success', 'Notification deleted successfully.');
    }

    public function destroyAll()
    {
        dd('delete all');
        $intern = Intern::where('user_id', auth()->id())->first();
        $intern->notifications()->delete();
        return back()->with('success', 'All notifications deleted successfully.');
    }
}