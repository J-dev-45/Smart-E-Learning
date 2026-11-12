<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RecentActivity;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // PROMOTE USER

    public function promoteUser(Request $request){
        $data = $request->validate([
            'new_role' => 'required|string|in:Admin,Student'
        ]);

        $user = User::find($request->user_id);

        $user->where('id', $request->user_id)->update([
            'role' => $data['new_role']
        ]);

        RecentActivity::create([
            'name' => auth()->user()->name,
            'action' => 'promoted_user',
            'target' => $user->name,
            'from_role' => $user->role,
            'to_role' => $data['new_role']
        ]);

        return response()->json([
            'success'=> true,
            'message'=> "$user->name was promoted successfully!"
        ]);
    }

    public function demoteUser(Request $request){
        $data = $request->validate([
            'new_role' => 'required|string|in:Admin,Student'
        ]);

        $user = User::find($request->user_id);

        $user->where('id', $request->user_id)->update([
            'role' => $data['new_role']
        ]);

        RecentActivity::create([
            'name' => auth()->user()->name,
            'action' => 'demoted_user',
            'target' => $user->name,
            'from_role' => $user->role,
            'to_role' => $data['new_role']
        ]);

        return response()->json([
            'success'=> true,
            'message'=> "$user->name was demoted successfully!"
        ]);
    }

    public function disableAccount(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $user = User::findOrFail($data['user_id']);

        if ($user->disabled) {
            return response()->json([
                'success' => false,
                'message' => 'This account is already disabled.'
            ], 422);
        }

        $user->disabled = true;
        $user->save();

        RecentActivity::create([
            'name' => auth()->user()->name,
            'action' => 'disabled_user',
            'target' => $user->name,
        ]);

        return response()->json([
            'success' => true,
            'disabled' => true,
            'message' => "{$user->name}'s account has been disabled successfully!"
        ]);
    }

    public function enableAccount(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $user = User::findOrFail($data['user_id']);

        if (!$user->disabled) {
            return response()->json([
                'success' => false,
                'message' => 'This account is already enabled.'
            ], 422);
        }

        $user->disabled = false;
        $user->save();

        RecentActivity::create([
            'name' => auth()->user()->name,
            'action' => 'enabled_user',
            'target' => $user->name,
        ]);

        return response()->json([
            'success' => true,
            'disabled' => false,
            'message' => "{$user->name}'s account has been enabled successfully!"
        ]);
    }
}
