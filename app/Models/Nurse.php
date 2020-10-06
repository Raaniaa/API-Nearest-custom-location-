<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class Nurse extends Model
{
    use HasFactory;
    use HasApiTokens; 
    protected $fillable = ['NurseName','address', 'latitude', 'longitude','phone','gender','photo'];
}
