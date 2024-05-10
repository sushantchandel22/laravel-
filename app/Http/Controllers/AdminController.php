<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function admin(Request $request)
    {
        $roles = Role::all();
        $users = User::with([
            'role' => function ($query){
                $query->with([
                    'permissions' => function ($query) {
                        $query->select('role_id', 'name', 'read', 'write', 'delete');
                    }
                ]);
            }
        ])->where('role_id', '!=', true)->get();
        return view('admin.admintable', compact('users', 'roles'));
    }

    public function toggleStatus(Request $request)
    {
        $userId = $request->id;
        $user = User::findOrFail($userId);
        $user->is_active = !$user->is_active;
        $user->save();
        if (!$user->is_active && Auth::user() && Auth::user()->id == $user->id) {
            Auth::logout();
        }
        $message = $user->is_active ?'User activated successfully':'User deactivated successfully';
        return redirect()->route('admin')->with('success', $message);   
    }
}
