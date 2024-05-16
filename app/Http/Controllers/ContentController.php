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
        // Get following count
        $notifications = Notification::where('user_id', $user->id)->orderByDesc('created_at')->get();

        return view('tbooke-learning.show', [
            'user' => $user,
            'notifications' => $notifications,
            'content' => $content,
        ]);
    }
}
