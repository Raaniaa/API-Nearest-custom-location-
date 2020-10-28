<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Doctor extends Model
{    use HasApiTokens;
    use HasFactory;
    protected $fillable = ['name','address', 'latitude', 'photo','longitude','specialtyName','phone','work_times','duration','telephone','fees'];
    protected $hidden = ['created_at','updated_at'];
    public function specialty(){
        return $this->belongsTo('App\Models\Specialty','specialtyName');
    }
}
