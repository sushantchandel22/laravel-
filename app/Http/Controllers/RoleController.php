<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, )
    {
        $role_id = $request->role_id;
        $value = false;
        $permissions = Permission::all();
        foreach ($permissions as $permission){
            $delete = $read = $write = false;
            $permission_id = $permission->id;
            if ($request->has('delete') && count($request->input('delete')) > 0) {
                if (array_key_exists($permission_id, $request->input('delete'))) {
                    $delete = true;
                }
            }
            if ($request->has('read') && count($request->input('read')) > 0) {
                if (array_key_exists($permission_id, $request->input('read'))) {
                    $read = true;
                }
            }
            if ($request->has('write') && count($request->input('write')) > 0) {
                if (array_key_exists($permission_id, $request->input('write'))) {
                    $write = true;
                }
            }
            ;
            RolePermission::updateOrCreate(
                ['role_id' => $role_id, 'permission_id' => $permission_id],
                ['delete' => $delete, 'read' => $read, 'write' => $write,]
            );
        }

        return back()->with('success', 'Data updated successfully!');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
