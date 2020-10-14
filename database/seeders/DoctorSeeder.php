<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $doctors = [
            ['id' => 1, 'name' => 'Ahmed Ali','address'=>'Shoubra','latitude'=>'30.123556',
            'longitude'=>'31.260940','specialtyName'=>'Audiologist','phone'=>'45455'],
            ['id' => 2, 'phone'=>'45455','name' => 'Mona Mokhtar','address'=>'Shoubra','latitude'=>'30.123027','longitude'=>'31.261123','specialtyName'=>'Audiologist'],
            ['id' => 3,'phone'=>'45455', 'name' => 'Amira Naseh','address'=>'Shoubra',
            'latitude'=>'30.122507','longitude'=>'31.262571','specialtyName'=>'Anesthesiologist'],
            ['id' => 4,'phone'=>'45455', 'name' => 'Abo Elala','address'=>'Shoubra',
            'latitude'=>'30.122767','longitude'=>'31.261198','specialtyName'=>'Andrologists'],
            ['id' => 5,'phone'=>'45455', 'name' => 'hamdi ali','address'=>'Shoubra',
            'latitude'=>'30.122814','longitude'=>' 31.260661','specialtyName'=>'Andrologists'],
    
    ];
        foreach($doctors as $doctor){
            Doctor::create($doctor);
        }
    }
}
