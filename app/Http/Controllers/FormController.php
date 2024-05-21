<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // Assuming Post is your model

class FormController extends Controller
{
    public function submitForm(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'content' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file types and size as needed
            'pdf' => 'file|mimes:pdf|max:2048',
        ]);

        // Process the form data and save it to the database
        $post = new Post();
        $post->content = $validatedData['content'];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images');
            $post->image = $imagePath;
        }

        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('pdfs');
            $post->pdf = $pdfPath;
        }

        $post->save();

        return response()->json(['message' => 'Post submitted successfully'], 200);
    }
}
