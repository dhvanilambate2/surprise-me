<?php

namespace App\Http\Controllers;

use App\Models\HomeDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class HomeForSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $homeDetails = HomeDetails::where('home_for', 'sale')->get();
        return view('backend.sale.index', ['homeDetails' => $homeDetails]);

    }

    public function getHomeDetails(Request $request)
    {
        $tab = $request->get('tab');

        switch ($tab) {
            case 'publish':
                $homeDetails = HomeDetails::where('home_for', 'sale')->where('status','publish')->get(); 
                break;
            case 'archive':
                $homeDetails = HomeDetails::where('home_for', 'sale')->where('status','archive')->get(); 
                break;
            case 'sold':
                $homeDetails = HomeDetails::where('home_for', 'sale')->where('status','sold')->get(); 
                break;
            case 'draft':
                $homeDetails = HomeDetails::where('home_for', 'sale')->where('status','draft')->get(); 
                break;
            case 'review':
                $homeDetails = HomeDetails::where('home_for', 'sale')->where('status','review')->get(); 
                break;
            default:
                $homeDetails = [];
                break;
        }
    
        // You can customize the data fetching logic based on your table structure and relationships
    
        $tableContent = view('backend.sale.table_content', ['homeDetails' => $homeDetails,'currentTab' => $tab])->render();
    
        return response()->json(['tableContent' => $tableContent ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.sale.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // $request->validate([
        //     'property_name' => 'required|string',
        //     'address' => 'required|string',
        //     'description' => 'required|string',
        //     'short_description' => 'required|string|max:100',
        //     'brochure' => 'nullable|file|mimes:pdf|max:10240', // Adjust the max file size as needed
        //     'status' => 'required|in:draft,review,publish', // Adjust the status values as needed
        //     'images.*' => 'required|image|mimes:jpeg,png,jpg,gif', // Adjust the max file size as needed
        //     'property_location' => 'required', // Adjust the status values as needed
        //     'main_image' => 'required',

        // ]);

        // Create a new HomeDetails instance and populate its properties
        $homeDetails = new HomeDetails();
        $homeDetails->property_name = $request->input('property_name');
        $homeDetails->address = $request->input('address');
        $homeDetails->description = $request->input('description');
        $homeDetails->sub_description = $request->input('short_description');
        $homeDetails->home_for = $request->input('home_for');
        $homeDetails->status = $request->input('status');
        $homeDetails->property_location = $request->input('property_location');


        // Save the home details
        $homeDetails->save();

        // Attach brochure if available
        if ($request->hasFile('brochure')) {
            $homeDetails->addMediaFromRequest('brochure')
                ->usingName($homeDetails->property_name)
                ->toMediaCollection('brochure');
        }

        // Attach images if available
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $homeDetails->addMedia($image)
                    ->usingName($homeDetails->property_name)
                    ->toMediaCollection('images');
            }
        }
        
         if ($request->hasFile('main_image')) {
            // Get the main image from the request
            $main_image = $request->file('main_image');
        
            // Generate a unique name for the main image
            $main_image_name = uniqid('main_image_') . '.' . $main_image->getClientOriginalExtension();
        
            // Move the main image to the public/images directory or any other desired directory
            $main_image->move(public_path('images'), $main_image_name);
        
            // Save the main image name in the 'main_image' field of the HomeDetails model
            $homeDetails->update(['main_image' => $main_image_name]);
        }
        // Redirect or respond as needed
        return redirect()->route('home_for_sale.index')->with('success', 'The Home for Sale has been added successfully.');

    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $homeDetails = HomeDetails::where('home_for', 'sale')->where('id', $id)->first();
        // dd($homeDetails);
        // Check if the HomeDetails was found
        if (!$homeDetails) {
            // Handle the case where the HomeDetails is not found, for example, redirect to index with an error message
            return redirect()->route('home_for_sale.index')->with('error', 'Not Found.');
        }

        // Load the associated media (brochures and images)
        $homeDetails->loadMedia('brochures', 'images');

        // Pass the $homeDetails to the view for displaying
        return view('backend.sale.show', compact('homeDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $homeDetails = HomeDetails::where('home_for', 'sale')->where('id', $id)->first();


        // Check if the HomeDetails was found
        if (!$homeDetails) {
            // Handle the case where the HomeDetails is not found, for example, redirect to index with an error message
            return redirect()->route('home_for_sale.index')->with('error', 'Not Found.');
        }

        // Load the associated media (brochures and images)
        $homeDetails->loadMedia('brochures', 'images');
        return view('backend.sale.edit', compact('homeDetails'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'property_name' => 'required|string',
            'address' => 'required|string|max:100',
            'price' => 'required',
            'badrooms' => 'required',
            'bathroom' => 'required',
            'description' => 'required',
            'short_description' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Find the HomeDetails record to update
        $homeDetails = HomeDetails::find($id);

        // Check if the HomeDetails was found
        if (!$homeDetails) {
            // Handle the case where the HomeDetails is not found, for example, redirect to index with an error message
            return redirect()->route('home_for_rent.index')->with('error', 'Not Found');
        }

        // Update the properties of the HomeDetails instance
        $homeDetails->property_name = $request->input('property_name');
        $homeDetails->address = $request->input('address');
        $homeDetails->description = $request->input('description');
        $homeDetails->sub_description = $request->input('short_description');
        $homeDetails->home_for = $request->input('home_for');
        $homeDetails->property_location = $request->input('property_location');
        $homeDetails->status = $request->input('status');
        $homeDetails->price = $request->input('price');
        $homeDetails->bedrooms = $request->input('badrooms');
        $homeDetails->bathrooms = $request->input('bathroom');
        $homeDetails->home_type = $request->input('home_type');
        $homeDetails->facebook = $request->input('facebook');
        $homeDetails->skype = $request->input('skype');
        $homeDetails->instagram = $request->input('instagram');
        $homeDetails->twitter = $request->input('twitter');
        $homeDetails->sqft_width = $request->input('sqft_width');
        $homeDetails->sqft_height = $request->input('sqft_height');
        $titles = $request->input('title');
        $oldTitlesJson = $homeDetails->titles;
        $oldTitlesArray = $oldTitlesJson ? json_decode($oldTitlesJson, true) : [];
        $mergedTitles = array_merge($oldTitlesArray, $titles);
        $newTitlesJson = json_encode($mergedTitles);
        $homeDetails->titles = $newTitlesJson;
        
        $old_main_image = $homeDetails->main_image;
        if ($request->hasFile('main_image')) {
            // Delete old main_image if it exists
            if ($old_main_image && file_exists(public_path('images/' . $old_main_image))) {
                unlink(public_path('images/' . $old_main_image));
            }
            
            $main_image = $request->file('main_image');
            $main_image_name = uniqid('main_image_') . '.' . $main_image->getClientOriginalExtension();
            $main_image->move(public_path('images'), $main_image_name);

            $homeDetails->main_image = $main_image_name;
        }

        $homeDetails->save();
        
         if ($request->hasFile('resources_images')) {
            foreach ($request->file('resources_images') as $resources_images) {
                $homeDetails->addMedia($resources_images)
                    ->usingName($homeDetails->property_name)
                    ->toMediaCollection('resources_images');
            }
        }

        $removedImageIds = explode(',', $request->input('removed_image_ids'));
        foreach ($removedImageIds as $removedImageId) {
            // Find the media item by ID
            $mediaItem = $homeDetails->getMedia('images')->find($removedImageId);

            // Delete the media item
            if ($mediaItem) {
                $mediaItem->delete();
            }
        }

      
        if ($request->hasFile('uploaded_images')) {
            foreach ($request->file('uploaded_images') as $image) {
                $homeDetails->addMedia($image)
                    ->usingName($homeDetails->property_name)
                    ->toMediaCollection('images');
            }
        }



        // Redirect or respond as needed
        // return redirect()->route('home_for_rent.index')->with('success', 'The Home for Rent has been updated successfully.');
        return response()->json(['success' => true], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the HomeDetails record to delete
        $homeDetails = HomeDetails::where('home_for', 'sale')->where('id', $id)->first();


        // Check if the HomeDetails was found
        if (!$homeDetails) {
            // Handle the case where the HomeDetails is not found, for example, redirect to index with an error message
            return redirect()->route('home_for_sale.index')->with('error', 'Not Found.');
        }

        // Delete associated media (brochures and images)
        $homeDetails->clearMediaCollection('brochure');
        $homeDetails->clearMediaCollection('images');

        // Delete the HomeDetails record
        $homeDetails->delete();

        // Redirect or respond as needed
        return redirect()->route('home_for_sale.index')->with('success', 'The Home for Rent has been deleted successfully.');
    }

    public function updateCurrentProject(Request $request)
    {
        $countCurrentProjects = HomeDetails::where('current_project', '1')->where('status','publish')->count();
        // dd($countCurrentProjects);
        
            $itemId = $request->input('id');
            $isCurrentProject = $request->input('is_current_project');   
            // dd($isCurrentProject == true);
            $homeDetails = HomeDetails::find($itemId);
            $massage = '';
            if($isCurrentProject == "true")
            {
                if($countCurrentProjects >= 3)
                {
                      return response()->json(['error'=> true,'massage' => 'You\'ve reached the maximum limit of 3 current projects.']);  
                }
                else
                {
                    $homeDetails->current_project = '1';
                    $massage = 'This project has been added to the current project list.';
                }
            }
            else
            {
                $homeDetails->current_project = '0';
                $massage = 'This project has been removed from the current project list.';
            }
            $homeDetails->save();
    

        return response()->json(['success'=> true,'massage' => $massage]);

    }
    
   public function updateStatus(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:publish,sold,archive,draft,review', // Valid status values
        ]);

        // Find the home for sale record by ID
        $homeForSale = HomeDetails::findOrFail($id);

        // Update the status
        $homeForSale->status = $validatedData['status'];
        $homeForSale->current_project = '0';
        $homeForSale->save();

        // Log success
        // Log::info("Status updated successfully for item $id.");

        return response()->json(['message' => 'Status updated successfully'], 200);
    }
    
    
}
