<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class Labs extends Model
{   use HasApiTokens;  
    use HasFactory;
    protected $fillable = ['LabName','address', 'latitude', 'longitude','phone'];
}
