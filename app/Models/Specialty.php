<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Specialty extends Model
{
    use HasFactory;
    use HasApiTokens;
    protected $fillable = ['specialtyName'];

    public function doctors(){
        return $this->hasMany('App\Models\Doctor','specialtyName');
    }
}
