<?php

namespace App\Http\Controllers;
use App\Models\HomeDetails;
use App\Models\Blog;
use App\Models\Inquiries;
use App\Models\ClientReview;
use App\Models\Team;
use App\Models\SiteSettng;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\InquiryReceived;
use App\Models\HomeSections;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    
    public function index()
    {
        // $teamSectionStatus = HomeSections::where('section_name', 'team_section')->first();
        // $reviewSectionStatus = HomeSections::where('section_name', 'review_section')->first();
        // $home_details = HomeDetails::where('current_project','1')->where('status','publish')->get();
        // $reviews = ClientReview::all();
        // $teams = Team::where('current_four', '1')->get();
        // $setting = SiteSettng::findOrFail('1'); 
        return view('frontend.index');
    }
    
  
    public function projects(Request $request)
    {
        $query = HomeDetails::where('status', 'publish');

        if ($request->filled('search')) {
            $query->where('address', 'like', '%' . $request->input('search') . '%');
        }
        if ($request->filled('home_for')) {
            $query->where('home_for', $request->input('home_for'));
        }
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }
        if ($request->filled('sqft_min')) {
            $query->where('sqft_width', '>=', $request->input('sqft_min'));
        }
        if ($request->filled('sqft_max')) {
            $query->where('sqft_width', '<=', $request->input('sqft_max'));
        }
        if ($request->filled('bads')) {
            $query->where('bedrooms', '>=', $request->input('bads'));
        }
        if ($request->filled('baths')) {
            $query->where('bathrooms', '>=', $request->input('baths'));
        }
        if ($request->filled('home_type')) {
            $query->where('home_type', $request->input('home_type'));
        }
        $homeDetails = $query->paginate(9);

        if ($request->ajax()) {
            return view('frontend.homeData', compact('homeDetails'))->render();
        }

        return view('frontend.projects', compact('homeDetails'));
    }
  
    public function homeForSale(Request $request)
    {
        $query = HomeDetails::where('status', 'publish')->where('home_for', 'sale');

        if ($request->filled('search')) {
            $query->where('address', 'like', '%' . $request->input('search') . '%');
        }
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }
        if ($request->filled('sqft_min')) {
            $query->where('sqft_width', '>=', $request->input('sqft_min'));
        }
        if ($request->filled('sqft_max')) {
            $query->where('sqft_width', '<=', $request->input('sqft_max'));
        }
        if ($request->filled('bads')) {
            $query->where('bedrooms', '>=', $request->input('bads'));
        }
        if ($request->filled('baths')) {
            $query->where('bathrooms', '>=', $request->input('baths'));
        }
        if ($request->filled('home_type')) {
            $query->where('home_type', $request->input('home_type'));
        }
        $homeDetails = $query->paginate(9);

        if ($request->ajax()) {
            return view('frontend.homeData', compact('homeDetails'))->render();
        }

        return view('frontend.home_for_sale', compact('homeDetails'));
    }
    public function saleDetails($id)
    {
        $wishlist_count = 0;
        if(Auth::check())
        {
            $user_id = Auth::user()->id;
            $wishlist_count = Wishlist::where('user_id', $user_id)->where('property_id', $id)->count();
        }
        
        $homeDetails = HomeDetails::where('home_for', 'sale')->where('id',$id)->first();
        if (!$homeDetails) {
            return redirect()->route('/');
        }
        $homeDetails->loadMedia('brochures', 'images');
        
        return view('frontend.details', compact('homeDetails','wishlist_count'));
    }


    public function homeForRent(Request $request)
    {
        $query = HomeDetails::where('status', 'publish')->where('home_for', 'rent');

        if ($request->filled('search')) {
            $query->where('address', 'like', '%' . $request->input('search') . '%');
        }
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }
        if ($request->filled('sqft_min')) {
            $query->where('sqft_width', '>=', $request->input('sqft_min'));
        }
        if ($request->filled('sqft_max')) {
            $query->where('sqft_width', '<=', $request->input('sqft_max'));
        }
        if ($request->filled('bads')) {
            $query->where('bedrooms', '>=', $request->input('bads'));
        }
        if ($request->filled('baths')) {
            $query->where('bathrooms', '>=', $request->input('baths'));
        }
        if ($request->filled('home_type')) {
            $query->where('home_type', $request->input('home_type'));
        }
        $homeDetails = $query->paginate(9);

        if ($request->ajax()) {
            return view('frontend.homeData', compact('homeDetails'))->render();
        }

        return view('frontend.home_for_rent', compact('homeDetails'));
    }
    public function rentDetails($id)
    {
        $wishlist_count = 0;
        if(Auth::check())
        {
            $user_id = Auth::user()->id;
            $wishlist_count = Wishlist::where('user_id', $user_id)->where('property_id', $id)->count();
        }
        
        $homeDetails = HomeDetails::where('home_for', 'rent')->where('id',$id)->first();
        if (!$homeDetails) {
            return redirect()->route('/');
        }
        $homeDetails->loadMedia('brochures', 'images');
        
        return view('frontend.details', compact('homeDetails','wishlist_count'));
    }

    public function blogs()
    {
        $blogs = blog::where('status','publish')->get();
        return view('frontend.blog', ['blogs' => $blogs]);
    }
    public function blogDetails($id)
    {
        $latest = blog::latest()->where('id', '!=', $id)->where('status','publish')->take(3)->get();
        // $latest = blog::where('status','publish')->where('id', '!=', $id)->take(3)->get();
        $blogs = blog::find($id);
        if (!$blogs) {
            return redirect()->route('/');
        }
        $blogs->loadMedia('blogs');
        // return view('frontend.blog_details', compact('blogs','latest'));
        return view('frontend.blog_details', ['blogs' => $blogs, 'latest' => $latest]);
    }

    
    public function contact()
    {
        return view('frontend.contact');
    }
    public function contactStore(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'number' => 'required|numeric',
        //     'subject' => 'required|string|max:255',
        //     'email' => 'required|email|max:255',
        //     'message' => 'required|string',
        //     'hid' => 'required',
        //     'home_mode' => 'required',
            
        // ]);
        // Create a new instance of the Contact model
        $contact = new Inquiries();

        // Assign values from the request to the model attributes
        $contact->name = $request->input('name');
        $contact->number = $request->input('number');
        $contact->subject = $request->input('subject');
        $contact->email = $request->input('email');
        $contact->massage = $request->input('message');
        $contact->hid = $request->input('hid');
        $contact->home_mode = $request->input('home_mode');

        // Save the model to the database
        $contact->save();
       
        // Mail::to('your_email@example.com')->send(new InquiryReceived($inquiry));

        // You may want to send an email notification, display a flash message, etc.

        // Redirect back or to a thank you page
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

    public function teamDetails($id)
    {
        $team = Team::find($id);
        if (!$team) {
            return redirect()->route('/');
        }
        $team->loadMedia('teams');
        return view('frontend.team-details', compact('team'));
    }
    
    public function homeSearch(Request $request)
    {
        $homeDetails = HomeDetails::where('status','publish');
        
        if($request->input('search'))
        {
            $search = $request->input('search');
            $homeDetails->where('address','like', '%'.$search.'%');
        }
        
        if($request->input('home_for'))
        {
            $homeFor = $request->input('home_for');
            $homeDetails->where('home_for', $homeFor);
        }
        
        $minPrice = $request->input('min_price');
        if ($minPrice !== null) {
            $homeDetails->where('price', '>=', $minPrice);
        }
        
        $maxPrice = $request->input('max_price');
        if ($maxPrice !== null) {
            $homeDetails->where('price', '<=', $maxPrice);
        }
        
         $homeType = $request->input('home_type');
        if ($homeType !== null) {
            $homeDetails->where('home_type', $homeType);
        }
            
            $homeDetails = $homeDetails->paginate(9);
            
            
        if ($request->ajax()) {
            $view = view('frontend.homeData', ['homeDetails' => $homeDetails])->render();
            return response()->json(['status' => 'success', 'view' => $view]);
        }
    }
        
        
    public function teams()
    {
        $teams = Team::all();
        return view('frontend.teams',['teams' => $teams,]);
    }
}
