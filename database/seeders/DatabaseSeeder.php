<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();

       // $this->call(UserSeeder::class);

       //Specialty::factory(30)->create();
      $this->call(Specialtyy::class);
       $this->call(PharamacySeeder::class);
       $this->call(DoctorSeeder::class);
       $this->call(BannerSeeder::class);
       $this->call(NurseSeeder::class);
       $this->call(LabSeeder::class);
       $this->call(XraySeeder::class);



       

    }
}
