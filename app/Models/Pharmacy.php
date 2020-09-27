<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Pharmacy extends Model
{
    use HasApiTokens;
    use HasFactory;
    protected $fillable = ['name', 'phone', 'photo', 'address', 'latitude', 'longitude'];

}
