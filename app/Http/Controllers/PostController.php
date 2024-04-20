<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

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
}

