<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolsCornerController extends Controller
{
    //
    public function schoolsCorner(Request $request)
    {
        // Your code logic here
        $user = Auth::user();
        return view('schools-corner', compact('user'));
    }
}
