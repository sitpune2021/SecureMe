<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session; 

class InstantEmergencyGroupController extends Controller
{

    public function InstantEmergencyGroups(){
        return view('admin.instant_emergency_groups_list');
    }
}
