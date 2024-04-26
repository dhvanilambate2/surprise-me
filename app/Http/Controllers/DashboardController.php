<?php

namespace App\Http\Controllers;

use App\Models\HomeDetails;
use App\Models\User;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $homeSaleDetails = HomeDetails::where('home_for', 'sale')->where('status','sold')->get();
        $saleMonthlyCounts = [];
        
        foreach ($homeSaleDetails as $homeDetail) {
            $month = date('n', strtotime($homeDetail->created_at));
        
            if (!isset($saleMonthlyCounts[$month])) {
                $saleMonthlyCounts[$month] = 1;
            } else {
                $saleMonthlyCounts[$month]++;
            }
        }
        $countSales = array_sum($saleMonthlyCounts);

        $usersDetails = User::where('role', 'admin')->get();
        $usersMonthlyCounts = [];
        foreach ($usersDetails as $userDetail) {
            $month = date('n', strtotime($userDetail->created_at));
    
            if (!isset($usersMonthlyCounts[$month])) {
                $usersMonthlyCounts[$month] = 1;
            } else {
                $usersMonthlyCounts[$month]++;
            }
        }
        $countUsers = array_sum($usersMonthlyCounts);
        
      $homeDetails = HomeDetails::where('status','publish')->get();
        $homeMonthlyCounts = [];
        
        foreach ($homeDetails as $homeDetail) {
            $month = date('n', strtotime($homeDetail->created_at));
        
            if (!isset($homeMonthlyCounts[$month])) {
                $homeMonthlyCounts[$month] = 1;
            } else {
                $homeMonthlyCounts[$month]++;
            }
        }
        $countHomes = array_sum($homeMonthlyCounts);
        

        return view('backend.dashboard.index',['sale_count' => $saleMonthlyCounts, 
                                            'total_sale_count' => $countSales, 
                                            'user_count' => $usersMonthlyCounts, 
                                            'total_user_count' => $countUsers,
                                            'home_count' => $homeMonthlyCounts,
                                            'total_home_count' => $countHomes,
                                            ]);
    }
    
    
    public function login()
    {
        if(Auth::check())
        {
             if (!Auth::user()->hasRole('user')) {
                return redirect('admin/dashboard');
            }
            // return redirect('admin/dashboard');
        }
        return view('backend.auth.login');
    }
}
