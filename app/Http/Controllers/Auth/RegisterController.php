<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\StudentRecord;
use App\Models\User;
use App\Services\MailerService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function register(Request $request, MailerService $mailerService)
    {
        $validated_data = $request->validate([
            'id_number' => [
                'required',
                'string',
                'max:50',
                Rule::unique('users', 'id_number'),
            ],
            'name' => [
                'required',
                'string',
                Rule::unique('users', 'name')->where('role', 'Student'),
            ],
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed'
        ], [
            'id_number.required' => 'Student ID number is required.',
            'id_number.unique' => 'This ID number is already registered to an account.',
            'name.unique' => 'This name is already taken. Please choose a different name.',
            'email.unique' => 'This email already exists. Please try logging in instead.',
        ]);

        // Verify the ID number exists in the pre-approved student records and is not disabled
        $studentRecord = StudentRecord::where('id_number', $validated_data['id_number'])->first();

        if (!$studentRecord) {
            return response()->json([
                'success' => false,
                'errors'  => [
                    'id_number' => ['This ID number is not found in the student records. Please contact your administrator.'],
                ],
            ], 422);
        }

        if ($studentRecord->is_disabled) {
            return response()->json([
                'success' => false,
                'errors'  => [
                    'id_number' => ['This student ID number has been disabled. Please contact your administrator.'],
                ],
            ], 422);
        }

        $profile_colors = [
            'bg-green-600 text-white',
            'bg-orange-800 text-white',
            'bg-blue-600 text-white'
        ];

        $otp_code = rand(100000, 999999);

        $user = User::create([
            'id_number' => $validated_data['id_number'],
            'name' => $validated_data['name'],
            'email' => $validated_data['email'],
            'password' => Hash::make($validated_data['password']),
            'profile_color' => Arr::random($profile_colors),
            'otp_verification' => $otp_code,
            'otp_expiration' => Carbon::now()->addMinutes(10),
            'last_seen' => Carbon::now()
        ]);

        $mailSent = $mailerService->sendMail(
            $user->email,
            $user->name,
            (string) $otp_code
        );

        if (!$mailSent) {
            $user->update([
                'otp_verification' => null,
                'otp_expiration' => null,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Your account was created, but we could not send the verification code. Please try again.',
            ], 500);
        }

        RateLimiter::clear('otp-resend:' . $user->id);
        RateLimiter::hit('otp-resend:' . $user->id, 60);

        session([
            'otp_session' => [
                'otp_id' => Str::random(40),
                'user_id' => $user->id
            ]
        ]);

        return response()->json([
            'success' => true,
            'url' => route('account_verification')
        ]);
    }
}