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
            'name' => 'required|string',
            'location' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'discounted_price' => 'nullable|numeric|min:0|lt:price',
            'phone' => 'required|string',
            'email' => 'required|string|email',
            'whatsapp' => 'required|string',
            'file' => 'nullable|file',
            'about' => 'required|string',
        ]);

        // Create a new resource instance and fill it with validated data
        $resource = new Resource();
        $resource->name = $validatedData['name'];
        $resource->location = $validatedData['location'];
        $resource->category = $validatedData['category'];
        $resource->price = $validatedData['price'];
        $resource->discounted_price = $validatedData['discounted_price'];
        $resource->phone = $validatedData['phone'];
        $resource->email = $validatedData['email'];
        $resource->whatsapp = $validatedData['whatsapp'];

        // Handle file upload if applicable
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = public_path('uploads');
            $file->move($filePath, $fileName);
            $resource->file = $fileName;
        }
        $resource->about = $validatedData['about'];

        $resource->save();
        
        // Return a JSON response containing the redirect URL
        return response()->json([
            'success' => true,
            'message' => 'Resource added successfully.',
            'redirect_url' => route('learning-resources', ['success' => true])
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
