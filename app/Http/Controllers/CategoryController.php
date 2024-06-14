<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:categories-list|categories-create|categories-edit|categories-delete', ['only' => ['index','store']]);
         $this->middleware('permission:categories-create', ['only' => ['create','store']]);
         $this->middleware('permission:categories-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:categories-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('backend.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);
    
        // Create a new Blog instance and populate its properties
        $category = new Category();
        $category->name = $request->input('name');
        if ($request->hasFile('main_image')) {
            $category->addMedia($request->file('main_image'))
                ->usingName($category->name)
                ->toMediaCollection('category_image');
        }
        // Save the blog category
        $category->save();
    
        // Redirect or respond as needed
        return response()->json(['success' => true], 200);
        // return redirect()->route('categories.index')->with('success', 'The Category has been added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::where('id',$id)->first();
        $category->loadMedia('category_image');

        if (!$category) {
            // Handle the case where the HomeDetails is not found, for example, redirect to index with an error message
            return redirect()->route('categories.index')->with('error', 'Not Found');
        }

        return view('backend.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        // Find the Blog record to update
        $category = Category::find($id);
       
        // Check if the Blog was found
        if (!$category) {
            // Handle the case where the Blog is not found, for example, redirect to index with an error message
            return redirect()->route('categories.index')->with('error', 'Not Found.');
        }

        // Update the properties of the Blog instance
        $category->name = $request->input('name');
        $category->clearMediaCollection('category_image');

        if ($request->hasFile('main_image')) {
            $category->addMedia($request->file('main_image'))
                ->usingName($category->name)
                ->toMediaCollection('category_image');
        }
        $category->save();

        return response()->json(['success' => true], 200);
        // return redirect()->route('categories.index')->with('success', 'The Category has been Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Not Found');
        }
        $category->clearMediaCollection('category_image');
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'The Category has been deleted successfully.');
    }


     /**
     * Image temp. storage for dropzone 
     */

     public function imgStore(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    
        $file = $request->file('file');
    
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
    
        // $file->move($path, $name);
    
        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
}
