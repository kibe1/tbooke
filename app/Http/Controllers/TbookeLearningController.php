<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TbookeLearningController extends Controller
{
    public function tbookeLearning(Request $request){
         // Your code logic here
    $user = Auth::user();
    return view('tbooke-learning', compact('user'));
    }
   
}
