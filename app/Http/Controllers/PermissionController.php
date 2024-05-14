<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;

use Illuminate\Http\Request;
use Validator;
class PermissionController extends Controller
{
    
    public function   showaddrole(){
        $roles['roles']= Role::all();
        return view('roles.addrole' ,$roles);
    }

    public function addrole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles|max:255', 
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $role = Role::create([
            'name' => $request->input('name'),
        ]);
    
        return redirect()->route('add_role')->with('success', 'Role added successfully.');
    }
    
    public function   showroles(){
        $roles ['roles'] = Role::all();
        return view('roles.showrole' , $roles);
    }
    public function assignroles(Request $request, $userId){
        $roles = Role::all();
        return view('roles.assignroles', compact('roles','userId'));
    }
    public function adduserole(Request $request)
    {
        $userId = $request->input('userId');
        $roleId = $request->input('select');

        $user = User::find($userId);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
        $user->role_id = $roleId;
        $user->save();
        return redirect()->back()->with('success', 'Role assigned successfully');
    }
}



    