<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\MailerService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class ResendOTP extends Controller
{
    private function getOtpSession(Request $request): ?array
    {
        $otpSession = $request->session()->get('otp_session');

        if (
            !is_array($otpSession) ||
            empty($otpSession['user_id'])
        ) {
            return null;
        }

        return $otpSession;
    }

    private function limiterKey(int $userId): string
    {
        return 'otp-resend:' . $userId;
    }


    public function status(Request $request)
    {
        $otpSession = $this->getOtpSession($request);

        if (!$otpSession) {
            return response()->json([
                'success' => false,
                'message' => 'Your verification session has expired. Please log in again.',
            ], 401);
        }

        $user = User::find($otpSession['user_id']);

        if (!$user || $user->email_verified_at !== null) {
            return response()->json([
                'success' => false,
                'message' => 'This verification session is no longer valid.',
            ], 401);
        }

        $remaining = RateLimiter::availableIn(
            $this->limiterKey((int) $user->id)
        );

        return response()->json([
            'success' => true,
            'remaining' => $remaining,
        ]);
    }

  
    public function resend(
        Request $request,
        MailerService $mailerService
    ) {
        $otpSession = $this->getOtpSession($request);

        if (!$otpSession) {
            return response()->json([
                'success' => false,
                'message' => 'Your verification session has expired. Please log in again.',
            ], 401);
        }

        $user = User::find($otpSession['user_id']);

        if (!$user || $user->email_verified_at !== null) {
            return response()->json([
                'success' => false,
                'message' => 'This verification session is no longer valid.',
            ], 401);
        }

        $key = $this->limiterKey((int) $user->id);

        $remaining = RateLimiter::availableIn($key);

        if ($remaining > 0) {
            return response()->json([
                'success' => false,
                'message' => "Please wait {$remaining} seconds before requesting another code.",
                'remaining' => $remaining,
            ], 429);
        }

        $otpCode = (string) random_int(100000, 999999);

        $sent = $mailerService->sendMail(
            $user->email,
            $user->name,
            $otpCode
        );

        if (!$sent) {
            return response()->json([
                'success' => false,
                'message' => 'We could not send your OTP. Please try again later.',
            ], 500);
        }

        $user->update([
            'otp_verification' => $otpCode,
            'otp_expiration' => Carbon::now()->addMinutes(10),
        ]);

        RateLimiter::clear($key);
        RateLimiter::hit($key, 60);

        return response()->json([
            'success' => true,
            'message' => 'A new verification code has been sent to your email.',
            'remaining' => 60,
        ]);
    }
}