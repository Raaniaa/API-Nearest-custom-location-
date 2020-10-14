<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Nurse;
class NurseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nurses=[
            ['id' => 1, 'name' => 'noha','phone'=>'4455666',
        'address'=>'Mohandseen','latitude'=>'30.053279','longitude'=>'31.199643'],
        ['id' => 2, 'name' => ' Sand','phone'=>'4455666',
        'address'=>'Mohandseen','latitude'=>'30.054227','longitude'=>' 31.200728'],
        ['id' => 3, 'name' => ' Ahmed','phone'=>'4455666',
        'address'=>'Mohandseen','latitude'=>'30.054434','longitude'=>'31.200669'],
        ['id' => 4, 'name' => ' khater','phone'=>'4455666',
        'address'=>'Mohandseen','latitude'=>'30.122880','longitude'=>'31.260833'],
    ];
    foreach($nurses as $nurse){
        Nurse::create($nurse);
    }
    }
}
