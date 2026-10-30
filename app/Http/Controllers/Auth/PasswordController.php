<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function changePassword(Request $request){
        $validated_data = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|same:password_confirmation',
            'password_confirmation' => 'required'
        ]);

        if(Hash::check($validated_data['old_password'], auth()->user()->password)){
            auth()->user()->update([
                'password' => Hash::make($validated_data['new_password']),
                'updated_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Password Changed Successfully!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'The old password is incorrect.'
        ], 422);
    }
}