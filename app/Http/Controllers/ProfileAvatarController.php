<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProfileAvatarController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'avatar' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated.',
            ], 401);
        }

        $file = $request->file('avatar');

        $extension = $file->extension();

        $path = 'profiles/'
            . $user->id
            . '/'
            . Str::uuid()
            . '.'
            . $extension;

        $baseUrl = rtrim(
            config('services.supabase.url'),
            '/'
        );

        $secretKey = config('services.supabase.secret_key');

        $bucket = config(
            'services.supabase.avatar_bucket',
            'pictures'
        );

        if (!$baseUrl || !$secretKey) {
            return response()->json([
                'message' => 'Supabase configuration is missing.',
            ], 500);
        }

        try {
            // Upload image to Supabase Storage.
            $response = Http::withHeaders([
                'apikey' => $secretKey,
                'Authorization' => 'Bearer ' . $secretKey,
                'Content-Type' => $file->getMimeType(),
                'x-upsert' => 'false',
            ])
                ->withBody(
                    file_get_contents($file->getRealPath()),
                    $file->getMimeType()
                )
                ->post(
                    $baseUrl
                    . '/storage/v1/object/'
                    . $bucket
                    . '/'
                    . $path
                );

            if (!$response->successful()) {
                return response()->json([
                    'message' => 'Failed to upload profile picture.',
                ], 500);
            }

            // Save uploaded picture and clear the other columns.
            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'profile_picture' => $path,
                    'profile_avatar' => null,
                    'profile_color' => null,
                ]);

            $imageUrl = $baseUrl
                . '/storage/v1/object/public/'
                . $bucket
                . '/'
                . $path;

            return response()->json([
                'message' => 'Profile picture updated successfully.',
                'profile_picture' => $path,
                'url' => $imageUrl,
            ]);

        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'message' => 'An error occurred while updating your profile picture.',
            ], 500);
        }
    }

    public function savePreset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'avatar' => ['required', 'string', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid avatar selection.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated.',
            ], 401);
        }

        // Accept only the ten predefined avatar filenames.
        $filename = basename(
            parse_url($request->input('avatar'), PHP_URL_PATH) ?? ''
        );

        if (!preg_match('/^Avatar_(10|[1-9])\.jpg$/', $filename)) {
            return response()->json([
                'message' => 'Please select a valid preset avatar.',
            ], 422);
        }

        // Save preset avatar path.
        $path = '/images/Profile_Avatars/' . $filename;

        try {
            // Save preset avatar and clear the other columns.
            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'profile_avatar' => $path,
                    'profile_picture' => null,
                    'profile_color' => null,
                ]);

            return response()->json([
                'message' => 'Preset avatar saved successfully.',
                'profile_avatar' => $path,
                'url' => asset($path),
            ]);

        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'message' => 'Failed to save the selected avatar.',
            ], 500);
        }
    }
}
