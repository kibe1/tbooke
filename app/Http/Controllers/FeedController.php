<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\ResharedPost;

class FeedController extends Controller
{
    
    public function feeds(Request $request)
    {
        $user = Auth::user();

        // Fetch all posts with their comments, ordered by latest post and comment
        $posts = Post::with(['comments' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->latest()
            ->get();

        // Check if the user has reshared each post and count the reshares
        foreach ($posts as $post) {
            $post->reshared = ResharedPost::where('user_id', $user->id)
                                           ->where('original_post_id', $post->id)
                                           ->exists();
            $post->reshare_count = ResharedPost::where('original_post_id', $post->id)
                                               ->count();
        }

        // If a post ID is provided in the query parameter, fetch comments for that post
        if ($request->has('post_id')) {
            $postId = $request->input('post_id');
            $post = Post::findOrFail($postId);
            $comments = $post->comments()->orderBy('created_at', 'desc')->get();

            // Update the posts variable to include only the post with the specified ID
            $posts = collect([$post]); // Convert the post to a collection for consistency
        } else {
            $comments = null; // No specific post ID provided, set comments to null
        }

        // Get notifications
        $notifications = Notification::with('sender')
            ->where('user_id', auth()->user()->id)
            ->where('read', 0)
            ->orderByDesc('created_at')
            ->get();
        $notificationCount = $notifications->count();

        return view('feed', compact('user', 'posts', 'comments', 'notifications', 'notificationCount'));
    
    }

    public function learning (Request $request) {
        
        $user = Auth::user();

        
        return view ('learning-resources', compact('user'));
    }
}
