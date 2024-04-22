<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolCornersController extends Controller
{
    //
    public function schoolCorner(Request $request)
    {
        // Your code logic here
        $user = Auth::user();
        return view('school-corners', compact('user'));
    }
}
