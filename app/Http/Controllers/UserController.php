<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function UsersList(Request $request)
    {
        $users = DB::table('users')
            ->select('id', 'name', 'email', 'created_at')
            ->orderBy('id', 'desc') 
            ->paginate(20);

        return view('admin.users_list', compact('users'));
    }
}