<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Homecare extends Model
{   use HasApiTokens;
    use HasFactory;
    protected $fillable = ['name','address', 'latitude', 'photo','longitude','specialtyName','phone','homecare','discription'];
    protected $hidden = ['created_at','updated_at'];
    protected $casts = [
        'homecare' => 'boolean',];
}
