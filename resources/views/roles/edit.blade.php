<?php
namespace App\Models;
?>
@extends('layouts.admin')
@section('mainsection')
@if(session('success'))
<div class='alert alert-success container mt-5'>
   {{session('success')}}
</div>
@endif
    <div class = 'border container p-5 mt-5 mb-5'>
        <form type="POST" action="{{ route('role.index') }}">
            @csrf
            <input type="hidden" name="role_id" id="role_id" value="{{ $role->id }}" />
            <h2 class="form-label">Role</h2><br>
            <h4 type="text" name="role_name" id="role_name" value = "{{ $role->name }}" >{{ ucfirst($role->name.':-') }}</h4><br><br>
            @foreach ($permissions as $permission)
                {{ucfirst ($permission->name) . ':-' }}
                <div class="d-flex  justify-content-evenly"> 
                    <div>
                        <input type="checkbox" id="read_{{ $permission->id }}" name="read[{{ $permission->id }}]"
                            value="true" @if (RolePermission::where('role_id', $role->id)->where('permission_id', $permission->id)->value('read')) checked @endif>
                        <label for="read_{{ $permission->id }}">Read</label><br>
                    </div>
                    <div>
                        <input type="checkbox" id="write_{{ $permission->id }}" name="write[{{ $permission->id }}]"
                            value="true" @if (RolePermission::where('role_id', $role->id)->where('permission_id', $permission->id)->value('write')) checked @endif>
                        <label for="write_{{ $permission->id }}"> Write</label><br>
                    </div>
                    <div>
                        <input type="checkbox" id="delete_{{ $permission->id }}" name="delete[{{ $permission->id }}]"
                            value="true" @if (RolePermission::where('role_id', $role->id)->where('permission_id', $permission->id)->value('delete')) checked @endif>
                        <label for="delete_{{ $permission->id }}"> Delete</label><br>
                    </div>
                </div>
            @endforeach
            <input class="btn btn-success rounded-0" type="submit" name="Submit" value="Save" />
        </form>
    </div>
@endsection
