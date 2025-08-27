<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // show Admin dashboard page
    public function AdminDashboard(){
        $stats = DB::table('emergency_signals')
            ->selectRaw('
                COUNT(*) as total_signals,
                SUM(CASE WHEN signal_status = "Active" THEN 1 ELSE 0 END) as active_emergency_signals,
                SUM(CASE WHEN signal_status = "Resolved" THEN 1 ELSE 0 END) as resolved_emergency_signals
            ')
            ->first();

        $users = DB::table('users')->count();
        $TotalPolices = DB::table('users')->where('user_role','police')->count();

        $total_helpers = DB::table('emergency_responses')
            ->where('status', 'completed')
            ->count();

        return view('admin.admin_dashboard', [
            'users' => $users,
            'active_emergency_signals' => $stats->active_emergency_signals,
            'resolved_emergency_signals' => $stats->resolved_emergency_signals,
            'total_helpers' => $total_helpers, 
            'TotalPolices' => $TotalPolices, 

        ]);
    }
}
