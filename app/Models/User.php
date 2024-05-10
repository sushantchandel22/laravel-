<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profileimage',
        'google_id',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $with = ['role'];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getNameAttribute($value)
    {
        $part = explode(' ', $value);
        $this->attributes['firstname'] = $part[0];
        $this->attributes['lastname'] = $part[1];
        return $this->firstname . ' ' . $this->lastname;
    }
    public function getIsAdminAttribute()
    {
        return $this->role_id === 1;
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function scopeActive($query){
        return $query->where('is_active' , true);
    }
    public function scopeInactive($query){
        return $query->where('is_active' , false);
    }

    public function gallery(){
        return $this->hasMnay(Gallery::class);
    }
    Public function roles(){
        return $this->belongsToMany(Role::class);
    }

    
}

