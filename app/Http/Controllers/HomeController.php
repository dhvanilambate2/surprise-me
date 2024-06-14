<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $role = Auth::user();

        // if ($role->type === 'admin') {
        //     return redirect('admin/dashboard');
        // } else{
        //     return redirect('/');
        // }
        return view('home');
    }

    public function about()
    {
        return view('frontend.about');
        
    }
    
    public function category()
    {
        return view('frontend.category');
    }
    
    public function vendor()
    {
        return view('frontend.vendor');
    }
    
    public function productlisting()
    {
        return view('frontend.product-listing');
    }
    
    public function contact()
    {
        return view('frontend.contact');
    }
}
