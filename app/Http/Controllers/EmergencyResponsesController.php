<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmergencyResponsesController extends Controller
{
    /**
     * Fetch all emergency responses with counts of accepted/rejected
     */
    public function AllEmergencyResponsesList()
    {
        // Fetch responses with user details and signal info
        $responses = DB::table('emergency_responses as er')
            ->join('emergency_signals as es', 'er.signal_id', '=', 'es.id')
            ->leftJoin('users as u', 'er.user_id', '=', 'u.id')
            ->select(
                'er.id',
                'er.signal_id',
                'er.responder_type',
                'er.response_action',
                'er.response_notes',
                'er.status',
                'er.created_at',
                'u.name as user_name',
                'u.email as user_email',
                'es.signal_status'
            )
            ->orderBy('er.id', 'desc')
            ->paginate(10);

        // Get Accepted / Rejected counts
        $counts = DB::table('emergency_responses')
            ->selectRaw("
                SUM(CASE WHEN response_action = 'Accepted' THEN 1 ELSE 0 END) as accepted_count,
                SUM(CASE WHEN response_action = 'Rejected' THEN 1 ELSE 0 END) as rejected_count
            ")
            ->first();
        // dd($counts);
        return view('admin.emergency_responses_lists', compact('responses', 'counts'));
    }
}
