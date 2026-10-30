<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\MailerService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request, MailerService $mailerService)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (!Auth::attempt($credentials, $remember)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Credentials'
            ], 422);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->email_verified_at === null) {
            $otp_code = rand(100009, 999999);

            $user->update([
                'otp_verification' => $otp_code,
                'otp_expiration' => Carbon::now()->addMinutes(10)
            ]);

            session([
                'otp_session' => [
                    'email' => $user->email,
                    'user_id' => $user->id
                ]
            ]);

            $mailerService->sendMail(
                $user->email,
                $user->name,
                $otp_code
            );

            Auth::logout();

            return response()->json([
                'success' => true,
                'requires_verification' => true,
                'url' => route('account_verification')
            ]);
        }

        if ($user->role === 'Admin') {
            return response()->json([
                'success' => true,
                'url' => route('dashboard_page')
            ]);
        }

        return response()->json([
            'success' => true,
            'url' => route('home')
        ]);
    }
}
