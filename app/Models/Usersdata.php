<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usersdata extends Model
{
    use HasFactory;
    protected $table ='usersdata';
    protected $primarykey = 'id';
}
