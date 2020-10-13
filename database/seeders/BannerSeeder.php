<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Banner;
class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $banners = [
            ['id' => 1, 'banner' => 'https://i.ibb.co/hdnnjv4/1.png'],
            ['id' => 2, 'banner' => 'https://i.ibb.co/89SMXZM/2.png'],
            ['id' => 3, 'banner' => 'https://i.ibb.co/8XzP3vq/3.png'],
            ['id' => 4, 'banner' => 'https://i.ibb.co/gmr7Tz5/4.png'],
            ['id' => 5, 'banner' => 'https://i.ibb.co/4wkthFM/5.png'],
            ['id' => 6, 'banner' => 'https://i.ibb.co/85jnbYp/6.png'],
    
    ];
        foreach($banners as $banner){
            Banner::create($banner);
        }
    }
}
