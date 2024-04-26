<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LearningResourcesController extends Controller
{
    //
    public function learningResource(Request $request)
    {
        // Your code logic here
        $user = Auth::user();
        return view('learning-resources', compact('user'));
    }
}