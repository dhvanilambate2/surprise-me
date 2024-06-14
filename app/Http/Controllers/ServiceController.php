<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Services;
use Illuminate\Support\Facades\Validator;


class ServiceController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:services-list|services-create|services-edit|services-delete', ['only' => ['index','store']]);
         $this->middleware('permission:services-create', ['only' => ['create','store']]);
         $this->middleware('permission:services-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:services-delete', ['only' => ['destroy']]);
    }


    public function index()
    {
        $services = Services::with('user', 'category')->get();

        return view('backend.services.index',['services' => $services]);
    }

    public function create()
    {
        $vendors = User::whereHas('roles', function($query) {
            $query->where('name', 'vendor');
        })->get();
       
        $categories = Category::all();
        return view('backend.services.create', ['categories' => $categories, 'vendors' => $vendors]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_name' => 'required|string',
            'sub_title' => 'required|string',
            'price' => 'required|string',
            'category' => 'required',
            'vendor' => 'required',
            'location' => 'required|string',
            'description' => 'required',
            'main_image' => 'required'
        ]);

        if ($validator->fails()) {  
            
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $services = new Services();
        $services->service_name = $request->input('service_name');
        $services->sub_title = $request->input('sub_title');
        $services->price = $request->input('price');
        $services->category_id = $request->input('category');
        $services->vendor_id = $request->input('vendor');
        $services->description = $request->input('description');
        $services->location = $request->input('location');
        $services->status = $request->input('status');
        $services->save();

        if ($request->hasFile('main_image')) {
            $services->addMedia($request->file('main_image'))
                ->usingName($services->service_name)
                ->toMediaCollection('front_image');
        }
        
        if ($request->hasFile('uploaded_images')) {
            foreach ($request->file('uploaded_images') as $image) {
                $services->addMedia($image)
                    ->usingName($services->service_name)
                    ->toMediaCollection('service_images');
            }
        }
        return response()->json(['success' => true], 200);
        
    }

    public function edit(string $id)
    {
        $vendors = User::whereHas('roles', function($query) {
            $query->where('name', 'vendor');
        })->get();
        $categories = Category::all();

        $services = Services::where('id', $id)->first();

        // Check if the HomeDetails was found
        if (!$services) {
            return redirect()->route('services.index')->with('error', 'Not Found.');
        }

        $services->loadMedia('service_images', 'front_image');
        return view('backend.services.edit', compact('services','categories','vendors'));
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'service_name' => 'required|string',
            'sub_title' => 'required|string',
            'price' => 'required|string',
            'category' => 'required',
            'vendor' => 'required',
            'location' => 'required|string',
            'description' => 'required',
            'main_image' => 'required'
        ]);
    
        if ($validator->fails()) {  
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Find the HomeDetails record to update
        $services = Services::find($id);

        // Check if the HomeDetails was found
        if (!$services) {
            // Handle the case where the HomeDetails is not found, for example, redirect to index with an error message
            return redirect()->route('services.index')->with('error', 'Not Found');
        }

        $services->service_name = $request->input('service_name');
        $services->sub_title = $request->input('sub_title');
        $services->price = $request->input('price');
        $services->category_id = $request->input('category');
        $services->vendor_id = $request->input('vendor');
        $services->description = $request->input('description');
        $services->location = $request->input('location');
        $services->status = 'review';

        $services->save();

        
        if ($request->hasFile('main_image')) {

            $services->clearMediaCollection('front_image');
            
            $services->addMedia($request->file('main_image'))
                ->usingName($services->service_name)
                ->toMediaCollection('front_image');
        }
    
        $removedImageIds = explode(',', $request->input('removed_image_ids'));
        foreach ($removedImageIds as $removedImageId) {
            // Find the media item by ID
            $mediaItem = $services->getMedia('service_images')->find($removedImageId);

            // Delete the media item
            if ($mediaItem) {
                $mediaItem->delete();
            }
        }

        if ($request->hasFile('uploaded_images')) {
            foreach ($request->file('uploaded_images') as $image) {
                $services->addMedia($image)
                    ->usingName($services->service_name)
                    ->toMediaCollection('service_images');
            }
        }



        return response()->json(['success' => true], 200);
    }
    public function updateStatus(Request $request, $id)
    {
            $validatedData = $request->validate([
                'status' => 'required|in:publish,rented,archive,draft,review', // Valid status values
            ]);
    
            // Find the home for sale record by ID
            $services = Services::findOrFail($id);
    
            // Update the status
            $services->status = $validatedData['status'];
            $services->save();
    
            return response()->json(['message' => 'Status updated successfully'], 200);
        
    }
}
