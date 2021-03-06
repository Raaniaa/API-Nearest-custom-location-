<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Pharmacy;
class PharamacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pharmacies=[
            ['id' => 1, 'name' => 'Pharmacy elazaby','phone'=>'4455666',
        'address'=>'Mohandseen','latitude'=>'30.053279','longitude'=>'31.199643'],
        ['id' => 2, 'name' => 'Pharmacy Sand','phone'=>'4455666',
        'address'=>'Mohandseen','latitude'=>'30.054227','longitude'=>' 31.200728'],
        ['id' => 3, 'name' => 'Pharmacy Mansheia','phone'=>'4455666',
        'address'=>'Mohandseen','latitude'=>'30.054434','longitude'=>'31.200669'],
        ['id' => 4, 'name' => 'Pharmacy khater','phone'=>'4455666',
        'address'=>'Mohandseen','latitude'=>'30.122880','longitude'=>'31.260833'],
    ];
    foreach($pharmacies as $pharmacy){
        Pharmacy::create($pharmacy);
    }
    }
}
