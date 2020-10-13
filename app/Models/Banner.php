<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class Banner extends Model
{ use HasApiTokens;
    use HasFactory;
    protected $fillable = ['banner'];
    protected $hidden = ['created_at','updated_at'];
}
