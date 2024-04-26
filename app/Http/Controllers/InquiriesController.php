<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiries;
use App\Models\HomeDetails;


class InquiriesController extends Controller
{

    // function __construct()
    // {
    //      $this->middleware('permission:Inquiries-list|Inquiries-create|Inquiries-edit|Inquiries-delete', ['only' => ['index','show']]);
    //      $this->middleware('permission:Inquiries-delete', ['only' => ['destroy']]);
    // }

    public function index()
    {
        $inquiries = Inquiries::all();
        return view('backend.inquiries.index',['inquiries' => $inquiries]);
    }
    
    public function getInquireDetails(Request $request)
    {
        $tab = $request->get('tab');

        switch ($tab) {
            case 'sale':
                $inquiriesDetails = Inquiries::with('HomeDetails')->where('home_mode', 'sale')->get(); 
                break;
            case 'rent':
                $inquiriesDetails = Inquiries::with('HomeDetails')->where('home_mode', 'rent')->get(); 
                break;
            case 'contact':
                $inquiriesDetails = Inquiries::with('HomeDetails')->where('home_mode', 'contact')->get(); 
                break;
            default:
                $inquiriesDetails = [];
                break;
        }
    
        // You can customize the data fetching logic based on your table structure and relationships
    
            $tableContent = view('backend.inquiries.table_content', ['inquiriesDetails' => $inquiriesDetails,'currentTab' => $tab])->render();
    
        return response()->json(['tableContent' => $tableContent ]);
    }
    
    public function show($id)
    {
        $inquiries = Inquiries::find($id);

        return view('backend.inquiries.show',['inquiries' => $inquiries]);
    }

    public function destroy(string $id)
    {
        $inquiries = Inquiries::find($id);
        $inquiries->delete();

        return redirect()->route('inquiries.index')->with('success', 'Enquiries have been successfully deleted');
    }

}
