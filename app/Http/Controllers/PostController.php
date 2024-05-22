<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\ResharedPost;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|string',
        ]);

        $post = new Post();
        $post->content = $validatedData['content'];
        $post->user_id = auth()->id();
        $post->save();

        return response()->json(['message' => 'Post created successfully'], 200);
    }

    public function sharePost(Request $request, Post $post)
    {
        $user = auth()->user();

        // Check if the user has already reshared this post
        $alreadyReshared = ResharedPost::where('user_id', $user->id)
                                        ->where('original_post_id', $post->id)
                                        ->exists();

        if ($alreadyReshared) {
            return response()->json(['message' => 'You have already reshared this post.'], 400);
        }

        // Create a new reshare record
        ResharedPost::create([
            'user_id' => $user->id,
            'original_post_id' => $post->id,
        ]);

        // Optionally, increase the reshare count on the original post
        $post->increment('reshares_count');

        //load repost modal

        return response()->json(['message' => 'Post reshared successfully!']);
    }

    
}

