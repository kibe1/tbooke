<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'messageTitle' => 'required|string|max:255',
            'messageContent' => 'required|string',
            'imageUpload' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'documentUpload' => 'file|mimes:pdf,doc,docx|max:2048',
            'importantCheckbox' => 'nullable|boolean',
            'upcomingCheckbox' => 'nullable|boolean',
        ]);

        $announcement = new Announcement();
        $announcement->title = $validatedData['messageTitle'];
        $announcement->content = $validatedData['messageContent'];

        if ($request->hasFile('imageUpload')) {
            $imagePath = $request->file('imageUpload')->store('images');
            $announcement->image = $imagePath;
        }

        if ($request->hasFile('documentUpload')) {
            $documentPath = $request->file('documentUpload')->store('documents');
            $announcement->document = $documentPath;
        }

        $announcement->is_important = $request->has('importantCheckbox');
        $announcement->is_upcoming = $request->has('upcomingCheckbox');
        $announcement->save();


          // Return a JSON response containing the redirect URL
        return response()->json([
            'success' => true,
            'message' => 'Announcement added successfully.',
            'redirect_url' => route('tbooke-blueboard', ['success' => true])  // Adjust this to the route of the page you want to redirect to
        ]);
    }
    public function index()
    {
        $user = Auth::user();
        $announcements = Announcement::latest()->get(); // Retrieve announcements from the database
        return view('tbooke-blueboard', compact('announcements'), compact('user'));
    }
}
