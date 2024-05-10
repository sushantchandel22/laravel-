<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Images;

class Gallery extends Model
{
    use HasFactory;
    public function Images(): HasMany
    {

        return $this->hasMany(Images::class);
    }
    public function user(){
        return $this->belongsTo(User::class ,'user_id');
    }
}
