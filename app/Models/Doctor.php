<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Doctor extends Model
{    use HasApiTokens;
    use HasFactory;
    protected $fillable = ['name','address', 'latitude', 'photo','longitude','specialtyName','phone','days','hours','duration','telephone','fees','description'];
    protected $hidden = ['created_at','updated_at'];
    protected $casts=['days'=>'array','hours'=>'array'];
    public function specialty(){
        return $this->belongsTo('App\Models\Specialty','specialtyName');
    }
}
