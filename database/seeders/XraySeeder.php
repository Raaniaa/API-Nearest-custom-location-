<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Xray;
class XraySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $xrays=[
            ['id' => 1, 'name' => 'Xray elazaby','phone'=>'4455666',
        'address'=>'Mohandseen','latitude'=>'30.053279','longitude'=>'31.199643'],
        ['id' => 2, 'name' => 'Xray Sand','phone'=>'4455666',
        'address'=>'Mohandseen','latitude'=>'30.054227','longitude'=>' 31.200728'],
        ['id' => 3, 'name' => 'Xray Mansheia','phone'=>'4455666',
        'address'=>'Mohandseen','latitude'=>'30.054434','longitude'=>'31.200669'],
        ['id' => 4, 'name' => 'Xray khater','phone'=>'4455666',
        'address'=>'Mohandseen','latitude'=>'30.122880','longitude'=>'31.260833'],
    ];
    foreach($xrays as $xray){
        Xray::create($xray);
    }
    }
}
