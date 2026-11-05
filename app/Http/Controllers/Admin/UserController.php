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


    public function deleteUser(Request $request){
        $user = User::find($request->user_id);
        $user->delete();

        RecentActivity::create([
            'name' => auth()->user()->name,
            'action' => 'deleted_user',
            'target' => $user->name,
        ]);

        return response()->json([
            'success' => true,
            'message' => "$user->name's Account has been deleted successfully!"
        ]);
    }
}
