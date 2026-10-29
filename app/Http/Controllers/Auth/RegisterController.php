<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\MailerService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(Request $request, MailerService $mailerService){
        $validated_data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed'
        ]);

        $profile_colors = [
            'bg-green-600 text-white',
            'bg-orange-800 text-white',
            'bg-blue-600 text-white'
        ];

        $otp_code = rand(100000, 999999);
        $id_number = random_int(100000000, 999999999);

        $user = User::create([
            'id_number' => $id_number,
            'name' => $validated_data['name'],
            'email' => $validated_data['email'],
            'password' => Hash::make($validated_data['password']),
            'profile_color' => Arr::random($profile_colors),
            'otp_verification' => $otp_code,
            'otp_expiration' => Carbon::now()->addMinutes(10),
            'last_seen' => Carbon::now()
        ]);

        $mailerService->sendMail($user->email, $user->name, $otp_code);

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
