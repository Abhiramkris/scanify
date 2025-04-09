<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Restaurant;

class DashboardController extends Controller
{

    public function index()
    {
        if (auth()->user()->isSuperAdmin()) {
            $admins = User::where('role', 'admin')->get();
            $restaurants = Restaurant::with('user')->get();
            return view('dashboard.super-admin', compact('admins', 'restaurants'));
        }
        
        if (auth()->user()->isAdmin()) {
            $restaurants = Restaurant::where('user_id', auth()->id())->get();
            return view('dashboard.admin', compact('restaurants'));
        }
        return redirect('/');
       // return redirect()->route('home');
    }

//     public function index()
// {
//     $user = auth()->user();
    
//     if ($user->role === 'super_admin') {
//         return view('dashboard.super-admin');
//     } elseif ($user->role === 'admin') {
//         return view('dashboard.admin');
//     } else {
//         return view('dashboard.user');
//     }
// }
}