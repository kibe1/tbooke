<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class ResourceController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'location' => 'required|string',
            'category' => 'required|string',
            'file' => 'nullable|file',
            'about' => 'required|string',
        ]);

        // Create a new resource instance and fill it with validated data
        $resource = new Resource();
        $resource->location = $validatedData['location'];
        $resource->category = $validatedData['category'];

        // Handle file upload if applicable
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            // Generate a unique filename
            $fileName = time() . '_' . $file->getClientOriginalName();
            // Specify the full path to the "uploads" directory
            $filePath = public_path('uploads');
            // Move the uploaded file to the specified directory
            $file->move($filePath, $fileName);
            // Set the file attribute to the filename
            $resource->file = $fileName;
        }
        $resource->about = $validatedData['about'];

        // Save the resource to the database
        $resource->save();
        
        // Return a JSON response containing the redirect URL
        return response()->json([
            'success' => true,
            'message' => 'Resource added successfully.',
            'redirect_url' => route('learning-resources', ['success' => true])  // Adjust this to the route of the page you want to redirect to
        ]);
    }

    public function index()
    {
        // Fetch all resources from the database
        $resources = Resource::all();
        // Pass the resources to the view
        $user = Auth::user();
        return view('learning-resources', ['resources' => $resources], compact('user'));
    }
}
