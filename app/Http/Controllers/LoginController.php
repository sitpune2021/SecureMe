<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session; 

class LoginController extends Controller
{
    // Show Admin login page
    public function AdminLogin(){
        return view('admin.login');
    }

    public function SaveLogin(Request $request){
         // Validate input
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Fetch admin from DB
        $admin = DB::table('admins')->where('email', $request->email)->first();
        
        if ($admin && Hash::check($request->password, $admin->password)) {
            // Regenerate session for security
            $request->session()->regenerate();

            // Store admin info in session
            Session::put('admin_id', $admin->id);
            Session::put('admin_email', $admin->email);
             // dd(Session::all()); 
            return redirect()->route('admin.dashboard')->with('success', 'Welcome back, Admin!');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function Logout(Request $request)
    {
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.admin-login')->with('success', 'Logged out successfully');
    }
}
