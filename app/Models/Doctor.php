<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Doctor extends Model
{    use HasApiTokens;
    use HasFactory;
    protected $fillable = ['DoctorName','address', 'latitude', 'longitude','specialtyName'];

    public function specialty(){
        return $this->belongsTo('App\Models\Specialty','specialtyName');
    }
}
