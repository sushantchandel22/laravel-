<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $with = ['permissions'];
    use HasFactory;
    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasOne(User::class);
    }
    // public function permissions(){
    //     return $this->hasMany(RolePermission::class,'permission_id','id');
    // }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission')
            ->withPivot('write', 'read', 'delete');
    }
}
// @if ($user->role && $user->role->permissions()->where('name', 'username')->first() && $user->role->permissions()->where('name', 'username')->first()->pivot->read)
//     <td>{{ ucfirst($user->name) }}</td>
// @endif
