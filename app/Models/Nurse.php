<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class Nurse extends Model
{
    use HasFactory;
    use HasApiTokens; 
    protected $fillable = ['name','address', 'latitude', 'longitude','phone','gender','photo'];
    protected $hidden = ['created_at','updated_at'];
}
