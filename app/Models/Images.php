<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Images extends Model
{
    use HasFactory;

    public function gallery(): BelongsTo
    {
        return $this->BelongsTo(Images::class);
   
    }   
    protected $fillable = ['gallery_id', 'image'];
}
