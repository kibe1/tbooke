<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\TbookeLearning; 
use Illuminate\Http\Request;
use App\Models\Notification;

class ContentController extends Controller
{
    public function show($slug)
    {
        $user = Auth::user();
        $content = TbookeLearning::where('slug', $slug)->firstOrFail();
        
        
        // Get notifications
        $notifications = Notification::with('sender')
        ->where('user_id', auth()->user()->id) 
         ->where('read', 0)
         ->orderByDesc('created_at')
         ->get();
         
        $notificationCount = $notifications->count();
        // 'notificationCount' => $notificationCount,

        return view('tbooke-learning.show', [
            'user' => $user,
            'notifications' => $notifications,
            'notificationCount' => $notificationCount,
            'content' => $content,
        ]);
    }
}
