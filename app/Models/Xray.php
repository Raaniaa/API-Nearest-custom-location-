<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class Xray extends Model
{use HasApiTokens;
    use HasFactory;
    protected $fillable = ['XrayName','address', 'latitude', 'longitude','phone'];

}
