<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Creator;
use App\Models\TbookeLearning;
use Alert;
use Illuminate\Support\Str;
use App\Models\Notification;

class TbookeLearningController extends Controller
{
    public function TbookeLearning(Request $request)
    {
        $user = Auth::user();
        $userIsCreator = Creator::where('user_id', $user->id)->exists();
        $contents = TbookeLearning::latest()->get();
    
        $notifications = Notification::where('user_id', $user->id)->orderByDesc('created_at')->get();

        return view('tbooke-learning', [
            'user' => $user,
            'notifications' => $notifications,
            'userIsCreator' => $userIsCreator,
            'contents' => $contents, // Pass the contents variable to the view
        ]);
    }    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content_title' => 'required|string|max:255',
            'content_thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max size as needed
            'content_category' => 'required|array', // Validate as an array
            'content' => 'required|string',
        ]);
    
        // Handle image upload
        $file = $request->file('content_thumbnail');
        $fileName = 'content_' . time() . '.' . $file->getClientOriginalExtension(); 
        $filePath = $file->storeAs('thumbnails', $fileName, 'public'); // Store the file in public/thumbnail-images
        $thumbnailPath  = $filePath; // Save the image path to the database
    
        // Convert array to comma-separated string
        $contentCategory = implode(',', $validatedData['content_category']);
        
        // Generate slug from the content title
        $slug = Str::slug($validatedData['content_title']);
    
        $content = new TbookeLearning();
        $content->content_title = $validatedData['content_title'];
        $content->content_thumbnail = $thumbnailPath;
        $content->content_category = $contentCategory; // Save as comma-separated string
        $content->content = $validatedData['content'];
        $content->slug = $slug;
        $content->user_id = auth()->id();
        $content->save();

        Alert::Success('Your Content has been added successfully');
        return redirect()->route('tbooke-learning');
    }
    public function index () {

        $user = Auth::user();
        return view('tbooke-learning.create', ['user' => $user]);
        
    }
   
}
