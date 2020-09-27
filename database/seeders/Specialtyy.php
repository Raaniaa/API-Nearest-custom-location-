<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specialty;
class Specialtyy extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $specailties = [
            ['id' => 1, 'specialtyName' => 'Audiologist'],
            ['id' => 2, 'specialtyName' => 'Anesthesiologist'],
            ['id' => 3, 'specialtyName' => 'Andrologists'],
            ['id' => 4, 'specialtyName' => 'Cardiologist'],
            ['id' => 5, 'specialtyName' => 'Cardiovascular'],
            ['id' => 6, 'specialtyName' => 'Cardiovascular Surgery'],
            ['id' => 7, 'specialtyName' => 'Neurologist'],
            ['id' => 8, 'specialtyName' => 'Dentist'],
            ['id' => 9, 'specialtyName' => 'Audiolog'],
            ['id' => 10, 'specialtyName' => 'dermatologist'],
            ['id' => 11, 'specialtyName' => 'Emergency Doctors'],
            ['id' => 12, 'specialtyName' => 'Endocrinologist'],
            ['id' => 13, 'specialtyName' => 'gynecologist'],
            ['id' => 14, 'specialtyName' => 'hematology'],
            ['id' => 16, 'specialtyName' => 'Hepatologists'],
            ['id' => 17, 'specialtyName' => 'Internists Gastroenterology Neonatologist'],
            ['id' => 18, 'specialtyName' => 'Orthopdist'],
            ['id' => 19, 'specialtyName' => 'Pediatrician'],
            ['id' => 20, 'specialtyName' => 'Plastic Surgeon'],
            ['id' => 21, 'specialtyName' => 'Surgeon'],
            ['id' => 22, 'specialtyName' => 'Urologist'],
            ['id' => 23, 'specialtyName' => 'Rheumatologist'],
            ['id' => 24, 'specialtyName' => 'Ophthalmologist'],
            ['id' => 25, 'specialtyName' => 'General Practitioner'],
            ['id' => 26, 'specialtyName' => 'Ear , Nose and Throat'],
            ['id' => 27, 'specialtyName' => 'Endoscopic Surgeon'],
            ['id' => 28, 'specialtyName' => 'Laboratory & Analytical'],
            ['id' => 29, 'specialtyName' => 'Pharmacist'],
            ['id' => 30, 'specialtyName' => 'Oncologist'],
    ];
        foreach($specailties as $spceailty){
            Specialty::create($spceailty);
        }
    }
}
