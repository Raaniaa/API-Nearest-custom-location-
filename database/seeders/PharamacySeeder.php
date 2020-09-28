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
        $pharmacies=[['id' => 1, 'name' => 'Pharmacy Ghalab','phone'=>'4455666',
        'address'=>'Shoubra','latitude'=>'30.122793','longitude'=>'31.260916'],
        ['id' => 2, 'name' => 'Pharmacy Sand','phone'=>'4455666',
        'address'=>'Shoubra','latitude'=>'30.126877','longitude'=>'31.270508'],
        ['id' => 3, 'name' => 'Pharmacy Mansheia','phone'=>'4455666',
        'address'=>'Shoubra','latitude'=>'30.122752','longitude'=>'31.261460'],
        ['id' => 4, 'name' => 'Pharmacy khater','phone'=>'4455666',
        'address'=>'Shoubra','latitude'=>'30.122880','longitude'=>'31.260833'],
    ];
    foreach($pharmacies as $pharmacy){
        Pharmacy::create($pharmacy);
    }
    }
}
