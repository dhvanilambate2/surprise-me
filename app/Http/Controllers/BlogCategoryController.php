<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog_categories = BlogCategory::where('status','Active')->get();
        return view('backend.blog_category.index', ['blog_categories' => $blog_categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.blog_category.create');
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
        $blog_category = new BlogCategory();
        $blog_category->name = $request->input('name');
    
        // Save the blog category
        $blog_category->save();
    
        // Redirect or respond as needed
        return redirect()->route('blog_categories.index')->with('success', 'The Blog Category has been added successfully.');
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
        $blog_category = BlogCategory::where('status','Active')->where('id',$id)->first();
        // Check if the HomeDetails was found

        if (!$blog_category) {
            // Handle the case where the HomeDetails is not found, for example, redirect to index with an error message
            return redirect()->route('blog_categories.index')->with('error', 'Not Found');
        }
;
        return view('backend.blog_category.edit', compact('blog_category'));
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
        $blog_category = BlogCategory::find($id);

        // Check if the Blog was found
        if (!$blog_category) {
            // Handle the case where the Blog is not found, for example, redirect to index with an error message
            return redirect()->route('blog_categories.index')->with('error', 'Not Found.');
        }

        // Update the properties of the Blog instance
        $blog_category->name = $request->input('name');

        $blog_category->save();

        return redirect()->route('blog_categories.index')->with('success', 'The Blog Category has been Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog_category = BlogCategory::find($id);

        if (!$blog_category) {
            return redirect()->route('blog_categories.index')->with('error', 'Not Found');
        }
        $blog_category->status = 'Inactive';

        $blog_category->save();

        return redirect()->route('blog_categories.index')->with('success', 'The Blog Category has been deleted successfully.');
    }
}
