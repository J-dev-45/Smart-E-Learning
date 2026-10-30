<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyOTP extends Controller
{
    public function verify(Request $request)
    {
        $otp_code = '';
        for ($i = 1; $i <= 6; $i++) {
            $otp_code .= trim((string) $request->input('otp' . $i));
        }

        if (strlen($otp_code) !== 6) {
            return response()->json([
                'success' => false,
                'message' => 'Please enter the 6-digit code.'
            ], 422);
        }

        $otp_session = session('otp_session');

        if (!$otp_session) {
            return response()->json([
                'success' => false,
                'message' => 'Your session has expired. Please log in again.'
            ], 422);
        }

        $user = User::findOrFail($otp_session['user_id']);

        if ($otp_code !== (string) $user->otp_verification) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP code.'
            ], 422);
        }

        if (!Carbon::now()->lessThan($user->otp_expiration)) {
            return response()->json([
                'success' => false,
                'message' => 'Your OTP has expired! Click Resend for a new OTP.'
            ], 422);
        }

        $user->update([
            'email_verified_at' => Carbon::now(),
            'otp_verification' => null,
            'otp_expiration' => null
        ]);

        session()->forget('otp_session');
        Auth::login($user);

        return response()->json([
            'success' => true,
            'url' => route('home')
        ]);
    }
}