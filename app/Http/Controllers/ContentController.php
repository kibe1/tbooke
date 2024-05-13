<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\TbookeLearning; 
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function show($slug)
    {
        $user = Auth::user();
        $content = TbookeLearning::where('slug', $slug)->firstOrFail();
        return view('tbooke-learning.show', [
            'user' => $user,
            'content' => $content,
        ]);
    }
}
