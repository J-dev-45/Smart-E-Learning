<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\MailerService;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function sendResetOtp(Request $request, MailerService $mailerService)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'No account found with that email address.'
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'No account found with that email address.'
            ], 422);
        }

        $otp_code = rand(100009, 999999);

        $user->update([
            'otp_verification' => $otp_code,
            'otp_expiration' => Carbon::now()->addMinutes(10)
        ]);

        session([
            'reset_password_session' => [
                'email' => $user->email,
                'user_id' => $user->id
            ]
        ]);

        if (!$mailerService->sendResetMail(
            $user->email,
            $user->name,
            $otp_code
        )) {
            return response()->json([
                'success' => false,
                'message' => 'We could not send the password reset email. Please try again later.'
            ], 502);
        }

        return response()->json([
            'success' => true,
            'message' => 'OTP sent to your email'
        ]);
    }

    public function verifyResetOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6'
        ]);

        $resetSession = session('reset_password_session');

        if (!$resetSession) {
            return response()->json([
                'success' => false,
                'message' => 'Session expired. Please request a new OTP.'
            ], 422);
        }

        $user = User::find($resetSession['user_id']);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ], 422);
        }

        if ($user->otp_verification != $request->otp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP code.'
            ], 422);
        }

        if (Carbon::now()->greaterThan(Carbon::parse($user->otp_expiration))) {
            return response()->json([
                'success' => false,
                'message' => 'OTP has expired. Please request a new one.'
            ], 422);
        }

        session(['reset_password_verified' => true]);

        return response()->json([
            'success' => true
        ]);
    }

    public function resetPassword(Request $request)
    {
        $resetSession = session('reset_password_session');

        if (!$resetSession || session('reset_password_verified') !== true) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Please verify your OTP first.'
            ], 422);
        }

        $request->validate([
            'password' => 'required|min:8|confirmed'
        ]);

        $user = User::find($resetSession['user_id']);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ], 422);
        }

        $user->update([
            'password' => $request->password,
            'otp_verification' => null,
            'otp_expiration' => null
        ]);

        session()->forget('reset_password_session');
        session()->forget('reset_password_verified');

        return response()->json([
            'success' => true,
            'message' => 'Password reset successfully'
        ]);
    }
}
