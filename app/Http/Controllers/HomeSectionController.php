<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeSections;

class HomeSectionController extends Controller
{
    public function store(Request $request)
    {
        $status = $request->input('status');
        $sectionName = $request->input('sectionName');
        
        HomeSections::where('section_name', $sectionName)->update(['status' => $status]);
        
        return response()->json(['success'=> true,'massage' => "Status Changed"]);
    }
}
