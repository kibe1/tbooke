<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Announcement; // Assuming you have a model named Announcement

class AnnouncementController extends Controller
{
    public function store(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'messageTitle' => 'required|string|max:255',
            'messageContent' => 'required|string',
        ]);

        // Create announcement
        $announcement = new Announcement();
        $announcement->title = $validatedData['messageTitle'];
        $announcement->content = $validatedData['messageContent'];
        $announcement->save();

       // Instead of returning JSON, you can redirect to the desired page
        return redirect()->route('tbooke-blueboard')->with('success', 'Announcement added successfully.');
    
}
    public function index()
    {
        $user = Auth::user();
        $announcements = Announcement::latest()->get(); // Retrieve announcements from the database
        return view('tbooke-blueboard', compact('announcements'),compact('user'));
    }
}

