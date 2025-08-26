<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SignalController extends Controller
{
    public function AllEmergencySignalsList()
    {
        $signals = DB::table('emergency_signals as es')
            ->join('users as u', 'u.id', '=', 'es.user_id')
            ->select(
                'es.id',
                'es.signal_id',
                'es.signal_status',
                'es.latitude',
                'es.longitude',
                'es.created_at',
                'u.name as user_name',
                'u.email as user_email',
                'u.phone_no as user_phone'
            )
            ->orderBy('es.id', 'desc')
            ->paginate(10);

        return view('admin.emergency_signals_list', compact('signals'));
    }

}
