<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TbookeBlueboardController extends Controller
{
    //
    public function tbookeBlueboard(Request $request)
    {
        // Your code logic here
        $user = Auth::user();
        return view('tbooke-blueboard', compact('user'));
    }
}
