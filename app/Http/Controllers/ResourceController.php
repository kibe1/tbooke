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
            'institution' => 'required|string',
            'category' => 'required|string',
            'subject' => 'required|string',
            'grade' => 'required|string',
            'name' => 'required|string',
            'phone' => 'required|string',
            'file' => 'nullable|file',
            'accessType' => 'required|string',
            'visibility' => 'required|string',
            'about' => 'required|string',
            'price' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
        ]);

        // Create a new resource instance and fill it with validated data
        $resource = new Resource();
        $resource->institution = $validatedData['institution'];
        $resource->category = $validatedData['category'];
        $resource->subject = $validatedData['subject'];
        $resource->grade = $validatedData['grade'];
        $resource->name = $validatedData['name'];
        $resource->phone = $validatedData['phone'];

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

        // Assign pricing and discount values if provided
        if (isset($validatedData['price'])) {
            $resource->price = $validatedData['price'];
        }

        if (isset($validatedData['discount'])) {
            $resource->discount = $validatedData['discount'];
        }

        $resource->access_type = $validatedData['accessType'];
        $resource->visibility = $validatedData['visibility'];
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
