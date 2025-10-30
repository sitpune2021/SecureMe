<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmergencyController extends Controller
{
    public function sendSignal(Request $request)
    {
        try {
            // ✅ Token-based authentication (from middleware)
            $authUserId = $request->user_id;
            if (!$authUserId) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Unauthorized. Invalid or missing token.'
                ], 401);
            }

            // ✅ Validate request
            $validated = $request->validate([
                'longitude'      => 'required|numeric|between:-180,180',
                'latitude'       => 'required|numeric|between:-90,90',
                'signal_status'  => 'nullable',
            ]);

            // ✅ Default values
            $status = $validated['signal_status'] ?? 'Active';
            $radius = 50; // starting radius in meters

            // ✅ Generate unique signal_id
            $signalIdStr = "SIG-" . date('Ymd') . "-" . strtoupper(uniqid());

            // ✅ Insert victim’s emergency signal
            $signalId = DB::table('emergency_signals')->insertGetId([
                'user_id'        => $authUserId,
                'signal_id'      => $signalIdStr,
                'signal_status'  => $status,
                'longitude'      => $validated['longitude'],
                'latitude'       => $validated['latitude'],
                'search_radius'  => $radius,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);

            // ✅ Fetch victim’s saved signal
            $victimSignal = DB::table('emergency_signals')->where('id', $signalId)->first();
            if (!$victimSignal) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Failed to fetch victim signal from DB.'
                ], 500);
            }

            $lat = $victimSignal->latitude;
            $lng = $victimSignal->longitude;
            $radius = $victimSignal->search_radius;
            
            // ✅ Fetch nearby users from user_locations table
            $nearbyUsers = DB::table('user_locations')
                ->join('users', 'user_locations.user_id', '=', 'users.id')
                ->select('users.id', 'users.fcm_token')
                ->selectRaw("
                    (6371000 * acos(
                        cos(radians(?)) * cos(radians(latitude)) *
                        cos(radians(longitude) - radians(?)) +
                        sin(radians(?)) * sin(radians(latitude))
                    )) AS distance
                ", [$lat, $lng, $lat])
                ->having('distance', '<=', $radius)
                ->whereNotNull('users.fcm_token')
                ->where('users.id', '!=', $authUserId) // exclude victim
                ->get();
           
            // ✅ Send push notifications
            foreach ($nearbyUsers as $user) {
                $this->sendPushNotification(
                    $user->fcm_token,
                    "🚨 Emergency Alert!",
                    "A user needs help near your location (within {$radius}m)."
                );
            }

            return response()->json([
                'status'         => true,
                'message'        => 'Emergency signal sent successfully.',
                'signal'         => $victimSignal,
                'notified_users' => $nearbyUsers->count()
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation failed.',
                'errors'  => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }




    // Respond to a signal
    public function respondSignal(Request $request)
    {
        $signalId = $request->signal_id;
        $userId   = $request->user()->id;

        DB::table('emergency_responses')->insert([
            'signal_id' => $signalId,
            'responder_id' => $userId,
        ]);

        // Check if responses >= 3 → Create group
        $count = DB::table('emergency_responses')->where('signal_id', $signalId)->count();

        if ($count >= 3) {
            $groupId = DB::table('emergency_groups')->insertGetId([
                'signal_id' => $signalId,
                'group_name' => "Emergency Group #$signalId",
            ]);

            $responders = DB::table('emergency_responses')
                ->where('signal_id', $signalId)
                ->pluck('responder_id');

            foreach ($responders as $responder) {
                DB::table('emergency_group_users')->insert([
                    'group_id' => $groupId,
                    'user_id' => $responder,
                ]);
            }
        }

        return response()->json(['status' => true, 'message' => 'Response recorded']);
    }

    // Expand radius (can be called by cron)
    public function expandRadius(Request $request)
    {
        $signals = DB::table('emergency_signals')->where('status', 'active')->get();

        foreach ($signals as $signal) {
            $newRadius = $signal->radius + 100; // expand by 100m
            if ($newRadius > 1000) $newRadius = 1000;

            DB::table('emergency_signals')
                ->where('id', $signal->id)
                ->update(['radius' => $newRadius]);

            // notify new users in expanded radius
            $users = DB::table('users')->whereNotNull('fcm_token')->get();
            foreach ($users as $user) {
                $this->sendPushNotification(
                    $user->fcm_token,
                    "Emergency Alert Updated!",
                    "Emergency radius expanded to {$newRadius}m."
                );
            }
        }

        return response()->json(['status' => true, 'message' => 'Radius expanded']);
    }

    // Push notification with Firebase
    private function sendPushNotification($token, $title, $body)
    {
        $SERVER_API_KEY = env('FCM_SERVER_KEY'); // put your Firebase key in .env

        Http::withHeaders([
            'Authorization' => 'key=' . $SERVER_API_KEY,
            'Content-Type' => 'application/json',
        ])->post('https://fcm.googleapis.com/fcm/send', [
            "to" => $token,
            "notification" => [
                "title" => $title,
                "body" => $body,
            ],
        ]);
    }

}
