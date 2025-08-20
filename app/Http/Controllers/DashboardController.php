<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // show Admin dashboard page
    public function AdminDashboard(){
        return view('admin.admin_dashboard');
    }
}
