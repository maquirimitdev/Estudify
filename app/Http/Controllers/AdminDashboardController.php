<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminDashboardController extends Controller
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
    
    return view('admin.dashboard', $data);
        }
        }
