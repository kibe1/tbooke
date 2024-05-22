<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class SchoolsCornerController extends Controller
{
    //
    public function schoolsCorner(Request $request)
    {
        // Your code logic here
        $user = Auth::user();

         // Get notifications
         $notifications = Notification::with('sender')
         ->where('user_id', auth()->user()->id) 
         ->where('read', 0)
         ->orderByDesc('created_at')
         ->get();
         $notificationCount = $notifications->count();
         // 'notificationCount' => $notificationCount,

        return view('schools-corner', compact('user', 'notifications', 'notificationCount'));
    }
}
