<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\HomeDetails;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $query = HomeDetails::with('wishlist')
                ->whereHas('wishlist', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->where('status', 'publish');
            
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
                    return view('frontend.wishlistData', compact('homeDetails'))->render();
                }
            return view('frontend.wishlist', compact('homeDetails'));
        } else {
            return redirect()->route('login')->with('error', 'Please log in to view your wishlist.');
        }
    }
    
    public function store(Request $request)
    {   
        if(Auth::check())
        {
            $user_id = Auth::user()->id;
            $property_id = $request->property_id;
            
            $wishlistItem = Wishlist::where('user_id', $user_id)
                                ->where('property_id', $property_id)
                                ->first();

            if($wishlistItem) {
                return response()->json(['error' => true, 'message' => 'Property already in Wishlist']);
            }
    
            Wishlist::create([
                'user_id' => $user_id,
                'property_id' => $property_id,
            ]);
    
            return response()->json(['success' => true, 'message' => 'Property added to Wishlist']);
        }
        else
        {
            return response()->json(['redirect'=> url('login')]);  
        }
    }
    
    public function destroy($id)
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['error' => true, 'message' => 'Unauthorized'], 401);
        }
        
        $wishlistItem = Wishlist::where('user_id', $user->id)
            ->where('property_id', $id)
            ->first();

        if (!$wishlistItem) {
            return response()->json(['error' => true, 'message' => 'Wishlist item not found'], 404);
        }
        
        $wishlistItem->delete();
        
        return response()->json(['success' => true, 'message' => 'Wishlist item removed successfully']);
    }
}

