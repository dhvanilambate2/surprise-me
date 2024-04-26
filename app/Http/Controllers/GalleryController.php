<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $model = Gallery::find(1); 
        return view('backend.gallery.index',compact('model'));
    }
    
    public function store(Request $request)
    {
        
         $model = Gallery::find(1); // Replace with your model instance or logic
        
        $model->addMedia($request->file('file'))
            ->toMediaCollection('gallery'); 
   
        return response()->json(['success'=>$request->file('file')]);
    }
    public function getImages()
    {
        $model = Gallery::find(1);
        return view('backend.gallery.images', compact('model'));
    }
}
