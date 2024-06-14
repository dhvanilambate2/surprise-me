<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\VendorShop;
use Illuminate\Support\Facades\Validator;

class VendorShopController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:vendors-shop-list|vendors-shop-create|vendors-shop-edit|vendors-shop-delete', ['only' => ['index','store']]);
         $this->middleware('permission:vendors-shop-create', ['only' => ['create','store']]);
         $this->middleware('permission:vendors-shop-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:vendors-shop-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $vendorShops = vendorShop::with('user', 'category')->get();
        // foreach($vendorShops as $vendorShop)
        // {
        //     $vendorShop->loadMedia('logo_image','images');
        // }
        // dd($vendorShops);

        return view('backend.vendor_shop.index',['vendorShops' => $vendorShops]);
    }

    public function create()
    {
        $vendors = User::whereHas('roles', function($query) {
            $query->where('name', 'vendor');
        })->get();
       
        $categories = Category::all();
        return view('backend.vendor_shop.create', ['categories' => $categories, 'vendors' => $vendors]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'shop_name' => 'required|string',
            'category' => 'required',
            'vendor' => 'required',
            'address' => 'required|string',
            'phone' => 'required|string',
            'description' => 'required',
            'main_image' => 'required'
        ]);

        if ($validator->fails()) {  
            
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $vendorShop = new vendorShop();
        $vendorShop->shop_name = $request->input('shop_name');
        $vendorShop->category_id = $request->input('category');
        $vendorShop->vendor_id = $request->input('vendor');
        $vendorShop->address = $request->input('address');
        $vendorShop->phone = $request->input('phone');
        $vendorShop->description = $request->input('description');
        $vendorShop->save();

        if ($request->hasFile('main_image')) {
            $vendorShop->addMedia($request->file('main_image'))
                ->usingName($vendorShop->shop_name)
                ->toMediaCollection('logo_image');
        }
        
        if ($request->hasFile('uploaded_images')) {
            foreach ($request->file('uploaded_images') as $image) {
                $vendorShop->addMedia($image)
                    ->usingName($vendorShop->shop_name)
                    ->toMediaCollection('images');
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

        $VendorShop = VendorShop::where('id', $id)->first();

        // Check if the HomeDetails was found
        if (!$VendorShop) {
            // Handle the case where the HomeDetails is not found, for example, redirect to index with an error message
            return redirect()->route('vendor_shop.index')->with('error', 'Not Found.');
        }

        // Load the associated media (brochures and images)
        $VendorShop->loadMedia('logo_image', 'images');
        return view('backend.vendor_shop.edit', compact('VendorShop','categories','vendors'));
    }



    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'shop_name' => 'required|string',
            'category' => 'required',
            'vendor' => 'required',
            'address' => 'required|string',
            'phone' => 'required|string',
            'description' => 'required',
            'main_image' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Find the HomeDetails record to update
        $VendorShop = VendorShop::find($id);

        // Check if the HomeDetails was found
        if (!$VendorShop) {
            // Handle the case where the HomeDetails is not found, for example, redirect to index with an error message
            return redirect()->route('vendor_shop.index')->with('error', 'Not Found');
        }

        $VendorShop->shop_name = $request->input('shop_name');
        $VendorShop->category_id = $request->input('category');
        $VendorShop->vendor_id = $request->input('vendor');
        $VendorShop->address = $request->input('address');
        $VendorShop->phone = $request->input('phone');
        $VendorShop->description = $request->input('description');
        $VendorShop->save();

        $VendorShop->clearMediaCollection('logo_image');

        if ($request->hasFile('main_image')) {
            $VendorShop->addMedia($request->file('main_image'))
                ->usingName($VendorShop->shop_name)
                ->toMediaCollection('logo_image');
        }
    
        $removedImageIds = explode(',', $request->input('removed_image_ids'));
        foreach ($removedImageIds as $removedImageId) {
            // Find the media item by ID
            $mediaItem = $VendorShop->getMedia('images')->find($removedImageId);

            // Delete the media item
            if ($mediaItem) {
                $mediaItem->delete();
            }
        }

      
        if ($request->hasFile('uploaded_images')) {
            foreach ($request->file('uploaded_images') as $image) {
                $VendorShop->addMedia($image)
                    ->usingName($VendorShop->shop_name)
                    ->toMediaCollection('images');
            }
        }



        // Redirect or respond as needed
        // return redirect()->route('home_for_rent.index')->with('success', 'The Home for Rent has been updated successfully.');
        return response()->json(['success' => true], 200);
    }


    public function destroy(string $id)
    {
        $vendorShop = vendorShop::find($id);
        if (!$vendorShop) {
            return redirect()->route('vendor_shop.index')->with('error', 'Not Found');
        }
        $vendorShop->clearMediaCollection('images');
        $vendorShop->clearMediaCollection('logo_image');
        $vendorShop->delete();

        return redirect()->route('vendor_shop.index')->with('success', 'The Category has been deleted successfully.');
    }


}
