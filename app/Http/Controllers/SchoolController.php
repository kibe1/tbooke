<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolPost;
use Illuminate\Support\Facades\Auth;

class SchoolController extends Controller
{
    public function saveSchoolPost(Request $request)
    {
        // Validate request
        $request->validate([
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max size and allowed file types as needed
            'video' => 'nullable|file|mimes:mp4,mov,avi|max:20480', // Adjust max size and allowed file types as needed
            'document' => 'nullable|file|mimes:pdf,doc,docx,txt|max:10240', // Adjust max size and allowed file types as needed
        ]);

        // Create new SchoolPost instance
        $schoolPost = new SchoolPost();
        $schoolPost->description = $request->description;

        // Handle file uploads and save paths to the database
        if ($request->hasFile('photo')) {
            $schoolPost->photo = $request->file('photo')->store('uploads/');
        }

        if ($request->hasFile('video')) {
            $schoolPost->video = $request->file('video')->store('uploads/');
        }

        if ($request->hasFile('document')) {
            $schoolPost->document = $request->file('document')->store('uploads/');
        }

        // Save the SchoolPost instance to the database
        $schoolPost->save();

        // Redirect or respond as needed
        return redirect()->back()->with('success', 'School post added successfully!');
    }

    public function displaySchoolPosts()
    {
        // Retrieve all school posts from the database
        $schoolPosts = SchoolPost::all();
        $user = Auth::user();
        return view('schools-corner', compact('schoolPosts', 'user'));
    }
}
