<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function UsersList()
    {
        $users = DB::table('users')
            ->select('id', 'name', 'email','user_role','phone_no', 'created_at')
            ->orderBy('id', 'desc') 
            ->paginate(10);
        // dd($users);
        return view('admin.users_list', compact('users'));
    }



    // function to show the user details Page
    public function UsersDetails($id)
    {
        $UsersDetails = DB::table('user_family_details')
            ->select('id', 'user_id', 'name', 'relation', 'age', 'created_at') 
            ->where('user_id', $id) 
            ->orderBy('id', 'desc')
            ->get();
        // dd($UsersDetails);
        return view('admin.view_user_details', compact('UsersDetails'));
    }
}