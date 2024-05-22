<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function likePost($postId)
    {
        $post = Post::findOrFail($postId);
        $user = Auth::user();

        if (!$user->likes()->where('post_id', $postId)->exists()) {
            $user->likes()->attach($postId);
            $likesCount = $post->likes()->count();
        }
       
        return response()->json(['likesCount' => $likesCount]);
    }

    public function unlikePost($postId)
    {
        $post = Post::findOrFail($postId);
        $user = Auth::user();

        if ($user->likes()->where('post_id', $postId)->exists()) {
            $user->likes()->detach($postId);
            $likesCount = $post->likes()->count();
        }

        return response()->json(['likesCount' => $likesCount]);
    }
}
