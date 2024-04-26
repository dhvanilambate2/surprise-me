<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeDetails;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('blogCategory')->get();
        return view('backend.blog.index', ['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $blog_categories = BlogCategory::where('status','Active')->get();
        return view('backend.blog.create', ['blog_categories' => $blog_categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'blog_category' => 'required',
            'content' => 'required|string',
            'status' => 'required|in:draft,review,publish',
        ]);

        if ($validator->fails()) {  
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        // Create a new Blog instance and populate its properties
        $blog = new Blog();
        $blog->title = $request->input('title');
        $blog->blog_category = $request->input('blog_category');
        $blog->content = $request->input('content');
        $blog->status = $request->input('status');
    
        // Save the blog
        $blog->save();
    
        if ($request->hasFile('uploaded_images')) {
            foreach ($request->file('uploaded_images') as $image) {
                $blog->addMedia($image)
                    ->usingName($blog->title)
                    ->toMediaCollection('blogs');
            }
        }
     
        // Redirect or respond as needed
        // return redirect()->route('blogs.index')->with('success', 'The Blog has been added successfully.');
        return response()->json(['success' => true], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blogs = blog::find($id);
        // Check if the HomeDetails was found

        if (!$blogs) {
            // Handle the case where the HomeDetails is not found, for example, redirect to index with an error message
            return redirect()->route('blogs.index')->with('error', 'Not Found');
        }

        // Load the associated media (brochures and images)
        $blogs->loadMedia('blogs');

        // Pass the $homeDetails to the view for displaying
        return view('backend.blog.show', compact('blogs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blogs = blog::find($id);
        $blog_categories = BlogCategory::where('status','Active')->get();

        // Check if the HomeDetails was found

        if (!$blogs) {
            // Handle the case where the HomeDetails is not found, for example, redirect to index with an error message
            return redirect()->route('blogs.index')->with('error', 'Not Found');
        }

        // Load the associated media (brochures and images)
        $blogs->loadMedia('blogs');
        return view('backend.blog.edit', compact('blogs','blog_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'blog_category' => 'required',
            'content' => 'required|string',
            'status' => 'required|in:draft,review,publish',
        ]);

        if ($validator->fails()) {  
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Find the Blog record to update
        $blog = Blog::find($id);

        // Check if the Blog was found
        if (!$blog) {
            // Handle the case where the Blog is not found, for example, redirect to index with an error message
            return redirect()->route('blogs.index')->with('error', 'Not Found');
        }

        // Update the properties of the Blog instance
        $blog->title = $request->input('title');
        $blog->blog_category = $request->input('blog_category');
        $blog->content = $request->input('content');
        $blog->status = $request->input('status');

        // Save the updated blog
        $blog->save();

        // Remove images based on the removed_image_ids field
        $removedImageIds = explode(',', $request->input('removed_image_ids'));
        foreach ($removedImageIds as $removedImageId) {
            // Find the media item by ID
            $mediaItem = $blog->getMedia('blogs')->find($removedImageId);

            // Delete the media item
            if ($mediaItem) {
                $mediaItem->delete();
            }
        }

         if ($request->hasFile('uploaded_images')) {
            foreach ($request->file('uploaded_images') as $image) {
                $blog->addMedia($image)
                    ->usingName($blog->title)
                    ->toMediaCollection('blogs');
            }
        }


        // Redirect or respond as needed
        return response()->json(['success' => true], 200);
        // return redirect()->route('blogs.index')->with('success', 'The Blog has been Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blogs = blog::find($id);

        if (!$blogs) {
            return redirect()->route('blogs.index')->with('error', 'Not Found');
        }

        // Delete associated media (brochures and images)
        $blogs->clearMediaCollection('blogs');

        // Delete the HomeDetails record
        $blogs->delete();

        // Redirect or respond as needed
        return redirect()->route('blogs.index')->with('success', 'The Blog has been deleted successfully.');
    }
}
