<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class SuperAdminDashboardController extends Controller
{
    public function index()
        {
            $data = [
                'total_users' => User::count(),
                'total_teachers' => User::where('user_type', 'TCH')->count(),
                'total_students' => User::where('user_type', 'STU')->count(),
                'total_admins' => User::where('user_type', 'ADM')->count(),
                'recent_users' => User::latest()->take(5)->get(),
            ];
            
            return view('superadmin.dashboard', $data);
        }
}
        
