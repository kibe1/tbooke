<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormSubmission;
use Illuminate\Support\Facades\Auth;

class FormController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'school_name' => 'required|string|max:255',
            'advertisement' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store the image file
        $imagePath = $request->file('image')->store('images');

        // Create a new form submission record
        $formSubmission = new FormSubmission();
        $formSubmission->school_name = $validatedData['school_name'];
        $formSubmission->advertisement = $validatedData['advertisement'];
        $formSubmission->image = $imagePath;
        $formSubmission->save();

        // Redirect back or show success message
        // Pass the resources to the view
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Resource added successfully.',
        //     'redirect_url' => route('schools-corner', ['success' => true])  // Adjust this to the route of the page you want to redirect to
        // ]);
        
        $user = Auth::user();
        return redirect()->back()->with('success', 'Form submitted successfully!');
    }
}
