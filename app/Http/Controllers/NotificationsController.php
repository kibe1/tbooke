<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationsController extends Controller
{
    
    public function markAsRead()
    {
        $userId = Auth::id();
        Notification::markAsRead($userId);

        return response()->json(['message' => 'Notifications marked as read']);
    }


}
